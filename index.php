<?php

require_once 'vendor/autoload.php';
use Google\Cloud\Firestore\FirestoreClient;

function CSVtoFirestore($CSV, $CollectionName, $AutoIncrementDocumentID = false)
{
    $db = new FirestoreClient();

    if ($handle = fopen($CSV, "r")) // Open CSV
    {
        $i=0;
        while (($data = fgetcsv($handle)) !== FALSE) // Go through CSV line-by-line
        {
            if ($i==0) // If we're on the header row
            {
                $fields = $data; // Set the fieldnames
            }
            else // If we're in the main body of the CSV
            {
                $j=0;
                foreach($data as $data_singular) // Go through each element of a line
                {
                    $DataToInput[$fields[$j]] = $data_singular; // Set the array of data to enter
                    $j++;
                }

                if ($AutoIncrementDocumentID) // If we're setting the document ID
                {
                    $db->collection($CollectionName)->document($i)->set($DataToInput);
                }
                else // If we're not
                {
                    $db->collection($CollectionName)->add($DataToInput);
                }
            }

            $i++;
        }

        return true;
    }
    else
    {
        return false;
    }
}

?>