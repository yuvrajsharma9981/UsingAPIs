<?php

echo '<table border=1>';
echo '<th>Lead Paragraph</th><th>Publication Date</th>';
foreach ($array as $object) {
    //to print articles and the hyperlink in form of the table
    echo '<tr><td><a href = "' . $object->web_url . '">' . $object->lead_paragraph . '</a></td>';
    echo '<td>' . $object->pub_date . '</td>';
}
echo '</table>';

