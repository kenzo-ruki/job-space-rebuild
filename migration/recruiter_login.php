<?php
// Open the input file
$file = fopen("recruiter_login.txt", "r");

// Open a new SQL file to write the UPDATE statements
$newFile = fopen("update_recruiter_login.sql", "w");

if ($file) {
    while (($line = fgets($file)) !== false) {
        // Use regex to extract recruiter_id and recruiter_email_address
        if (preg_match("/\((\d+),\s*'([^']+)'\)/", $line, $matches)) {
            
            $recruiter_id = $matches[1];
            $recruiter_email_address = $matches[2];

            // Escape the recruiter_email_address for use in a SQL statement
            $recruiter_email_address = addslashes($recruiter_email_address);

            // Construct the UPDATE SQL statement
            $updateStatement = "UPDATE `recruiters` SET `recruiter_email_address` = '{$recruiter_email_address}' WHERE `recruiter_id` = {$recruiter_id};\n";

            // Write the UPDATE SQL statement to the new SQL file
            fwrite($newFile, $updateStatement);
        }
    }

    fclose($file);
    fclose($newFile);
    echo "SQL update statements generated successfully in update_statements.sql\n";
} else {
    // Error opening the file
    echo "Error opening the input file.\n";
}