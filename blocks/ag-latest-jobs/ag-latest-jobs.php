<?php

/**
 * Latest Jobs Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$num_items_to_show = get_field('ag-latest-jobs-num-items');
$xml_feed_url = get_field('ag-latest-jobs-feed-url');

// Load the feed.

$feed = ag_get_latest_jobs($xml_feed_url, $num_items_to_show);

// Support custom "anchor" values.
$anchor = '';
if (! empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'ag-latest-jobs';
if (! empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
if ($background_color || $text_color) {
    $class_name .= ' has-custom-acf-color';
}

// Build a valid style attribute for background and text colors.
$styles = array('background-color: ' . $background_color, 'color: ' . $text_color);
$style  = implode('; ', $styles);

// PHP Functions

/**
 * Retrieve and parse XML job listings from a URL
 * 
 * @param string $url The URL of the XML file
 * @param int $numberOfJobs Number of jobs to retrieve (0 for all jobs)
 * @return array|string Jobs data or error message
 */

function ag_get_latest_jobs($url, $numberOfJobs = 0)
{
    // Step 1: Retrieve the XML from the URL
    $xmlContent = @file_get_contents($url);

    // Check if file retrieval was successful
    if ($xmlContent === false) {
        return "Error: Unable to retrieve XML from URL: $url";
    }

    // Step 2: Parse the XML content
    libxml_use_internal_errors(true); // Enable user error handling for XML
    $xml = simplexml_load_string($xmlContent);

    // Check if XML parsing was successful
    if ($xml === false) {
        $errors = libxml_get_errors();
        libxml_clear_errors();

        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = "Line {$error->line}: {$error->message}";
        }

        return "Error: Failed to parse XML. " . implode('; ', $errorMessages);
    }

    // Step 3: Navigate through XML structure to find job elements
    $jobs = [];
    $jobElements = null;

    // Try to find job elements using the structure from the provided XML
    if (
        isset($xml->document) &&
        isset($xml->document->document_content) &&
        isset($xml->document->document_content->jobfeed) &&
        isset($xml->document->document_content->jobfeed->jobs) &&
        isset($xml->document->document_content->jobfeed->jobs->job)
    ) {

        $jobElements = $xml->document->document_content->jobfeed->jobs->job;
    }
    // Alternative structure - direct jobs element
    elseif (isset($xml->jobs) && isset($xml->jobs->job)) {
        $jobElements = $xml->jobs->job;
    }
    // Another common structure
    elseif (isset($xml->job)) {
        $jobElements = $xml->job;
    }

    // Check if we found job elements
    if ($jobElements === null || count($jobElements) === 0) {
        return "No job elements found in the XML. Check the XML structure.";
    }

    // Step 4: Process the jobs
    $totalJobs = count($jobElements);
    $jobsToProcess = ($numberOfJobs > 0) ? min($numberOfJobs, $totalJobs) : $totalJobs;

    for ($i = 0; $i < $jobsToProcess; $i++) {
        $currentJob = $jobElements[$i];

        // Create a job info array with all available fields
        // This handles cases where some fields might be missing
        $jobInfo = [];

        // Loop through all child elements of the current job
        foreach ($currentJob->children() as $elementName => $elementValue) {
            // Handle nested elements differently if needed
            if ($elementName == 'location' && $elementValue->count() > 0) {
                $jobInfo['location'] = [];
                foreach ($elementValue->children() as $locName => $locValue) {
                    $jobInfo['location'][$locName] = (string)$locValue;
                }
            } else {
                $jobInfo[$elementName] = (string)$elementValue;
            }
        }

        $jobs[] = $jobInfo;
    }

    // Step 5: Return the results
    if (count($jobs) > 0) {
        return [
            'source_url' => $url,
            'total_jobs_in_feed' => $totalJobs,
            'jobs_processed' => $jobsToProcess,
            'jobs' => $jobs
        ];
    } else {
        return "No jobs were extracted from the XML.";
    }
}


?>

<div <?php echo esc_attr($anchor); ?>class="wp-block-columns alignwide is-layout-flex wp-container-core-columns-layout-1 <?php echo esc_attr($class_name); ?>" style="<?php echo esc_attr($style); ?>">
    <?php
    if (is_array($feed)) {
        foreach ($feed['jobs'] as $job) {
            $title = $job['title'];
            $location = $job['city'] . ', ' . $job['state'];
            $type = $job['EmploymentType'];
            $date = $job['posteddate'];
            $link = 'https://en.agilus.ca/jobs/jobdetails?jobId=' . $job['JobNumber'];
    ?>

            <div class="wp-block-column ag-latest-jobs__col" style="flex-basis:33.33%">
                <h3><?php echo ($title); ?></h3>
                <p><?php echo ($location); ?></p>
                <p><?php echo ($type); ?></p>
                <p><?php echo ($date); ?></p>
                <p><a href="<?php echo ($link); ?>">View job posting</a></p>
            </div>
        <?php } ?>
    <?php } ?>
</div>