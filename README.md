# CSVtoFirestore

To bridge my conceptual leap from SQL to NoSQL, I wanted to convert MySQL tables/CSV files to Google Cloud Platform's much looser Firestore database structure (where, effectively, a table is a collection and a row is a document).

## Execution
This script is designed to run in Google Cloud Platform's App Engine. For larger CSV files, this may be a problem and you may need to reconfigure it to run on a different server (or locally); if so, you'll find [this](https://cloud.google.com/firestore/docs/quickstart-servers#php) useful to authenticate, etc.

## Parameters
1. the location of the CSV (remote or local)
2. the name of the collection you'd like it in (think table name)
3. optionally, whether you want to set each document ID (think row ID) to auto increment or simply want Firestore to set it randomly (the default)

## Another one-off option
If you're not needing to do this dynamically, take a look at [Google's options](https://firebase.google.com/docs/firestore/manage-data/export-import) for importing and exporting to/from Firestore.
