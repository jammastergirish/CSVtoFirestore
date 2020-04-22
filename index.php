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
                    if (is_numeric($data_singular)) // Is it numeric?
                    {
                        $DataToInput[$fields[$j]] = doubleval($data_singular); // If so, add it to the data to be entered and ensure it goes in as a double
                    }
                    else
                    {
                        $DataToInput[$fields[$j]] = $data_singular; // If not, it'll go in as a string
                    }
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
