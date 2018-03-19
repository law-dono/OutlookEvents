<?php
use jamesiarmes\PhpEws\Client;
use jamesiarmes\PhpEws\Type;
use jamesiarmes\PhpEws\Request\FindItemType;
use jamesiarmes\PhpEws\Enumeration\ItemQueryTraversalType;
use jamesiarmes\PhpEws\Type\ItemResponseShapeType;
use jamesiarmes\PhpEws\Enumeration\DefaultShapeNamesType;
use jamesiarmes\PhpEws\Type\CalendarViewType;
use jamesiarmes\PhpEws\ArrayType\NonEmptyArrayOfBaseFolderIdsType;
use jamesiarmes\PhpEws\Type\DistinguishedFolderIdType;
use jamesiarmes\PhpEws\Enumeration\DistinguishedFolderIdNameType;
use jamesiarmes\PhpEws\Enumeration\ExceptionPropertyURIType;

/**
 * Returns outlook events on success.
 */
function outlook_events_list($account,$creation = FALSE) {

  $ews = new Client("outlook.office365.com", $account->mail, $account->password);

  // Set init class.
  $request = new FindItemType();

  // Use this to search only the items in the parent directory in question
  // or use ::SOFT_DELETED.
  $request->Traversal = ItemQueryTraversalType::SHALLOW;
  $request->ItemShape = new ItemResponseShapeType();
  $request->ItemShape->BaseShape = DefaultShapeNamesType::DEFAULT_PROPERTIES;

  // Define the timeframe to load calendar items.
  $request->CalendarView = new CalendarViewType();

  // Days of current Week.
  list($start_date, $end_date) = outlook_events_week_range(date('Y-m-d H:i:s'));
  $dates = outlook_events_date_range($start_date, $end_date);

  $request->CalendarView->StartDate = $start_date;
  $request->CalendarView->EndDate = $end_date;

  // Only look in the "calendars folder"
  $request->ParentFolderIds = new NonEmptyArrayOfBaseFolderIdsType();
  $request->ParentFolderIds->DistinguishedFolderId = new DistinguishedFolderIdType();
  $request->ParentFolderIds->DistinguishedFolderId->Id = DistinguishedFolderIdNameType::CALENDAR;

  try {
    $response = $ews->FindItem($request);
    if ($creation == TRUE) {

      return TRUE;
    }
    // Loop through each item if event(s) were found in the timeframe specified.
    if ($response->ResponseMessages->FindItemResponseMessage[0]->RootFolder->TotalItemsInView > 0) {

      $events = $response->ResponseMessages->FindItemResponseMessage[0]->RootFolder->Items->CalendarItem;

      return $events;
    }
    else {
      return array('', '');
    }
  }
  catch (\Exception $e) {
    if ($creation == TRUE) {
      return FALSE;
    }
    return array();
  }
}

/**
 * Returns the dates within date range().
 */
function outlook_events_date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d') {

  $dates = array();
  $current = strtotime($first);
  $last = strtotime($last);

  while ($current <= $last) {
    $dates[] = date($output_format, $current);
    $current = strtotime($step, $current);
  }

  return $dates;
}
