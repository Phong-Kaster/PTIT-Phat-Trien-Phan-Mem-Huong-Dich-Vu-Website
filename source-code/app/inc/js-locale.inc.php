<?php 
    /**
     * This is a temporary function used just in this file
     * It's being used to escape quotes for JS strings
     * @param  string $string 
     * @return string         
     */
    function js_str_format($string)
    {
        return str_replace("'", "\'", $string);
    }
?>
<script type="text/javascript" charset="utf-8">
    var __ = function(msgid) 
    {
        return window.i18n[msgid] || msgid;
    };

    window.i18n = {
        'Are you sure?': '<?= js_str_format(__('Are you sure?')) ?>',
        'It is not possible to get back removed data!': '<?= js_str_format(__("It is not possible to get back removed data!")) ?>',
        'Yes, Delete': '<?= js_str_format(__("Yes, Delete")) ?>',
        'Cancel': '<?= js_str_format(__("Cancel")) ?>',
        'Fill required fields': '<?= js_str_format(__("Fill required fields.")) ?>',
        'Please select at least 2 media album post.': '<?= js_str_format(__("Please select at least 2 media album post.")) ?>',
        'Please select one media for story post.': '<?= js_str_format(__("Please select one media for story post.")) ?>',
        'Please select one media for post.': '<?= js_str_format(__("Please select one media for post.")) ?>',
        'Please select an Instagram account to post.': '<?= js_str_format(__("Please select an Instagram account to post.")) ?>',
        'Oops! An error occured. Please try again later!': '<?= js_str_format(__("Oops! An error occured. Please try again later!")) ?>',
        'Use the TAB key to insert emoji faster': '<?= js_str_format(__('Use the TAB key to insert emoji faster')) ?>',
        'Total Posts': '<?= js_str_format(__("Total Posts")) ?>',
        'Followers': '<?= js_str_format(__("Followers")) ?>',
        'Following': '<?= js_str_format(__("Following")) ?>',
        'Uploading...': '<?= js_str_format(__("Uploading...")) ?>',
        'Do you really want to cancel automatic payments?': '<?= js_str_format(__("Do you really want to cancel automatic payments?")) ?>',
        'Yes, cancel automatic payments': '<?= js_str_format(__("Yes, cancel automatic payments")) ?>',
        'No': '<?= js_str_format(__("No")) ?>',
        'Verification': '<?= js_str_format(__("Verification")) ?>',
        'Searching for %s': '<?= js_str_format(__("Searching for %s...")) ?>',
        '+%s more': '<?= js_str_format(__("+%s more")) ?>'
    };
</script>

<script>
        //lang for datatables
        var overall             = __("Overall");
        var demptyTable         = __("No data available in table");
        var dshowing            = __("Showing");
        var dto                 = __("to");
        var dof                 = __("of");
        var dentries            = __("entries");
        var dinfoEmpty          = __("Showing 0 to 0 of 0 entries");
        var dfilter             = __("filtered from");
        var total               = __("Total");
        var dshow               = __("Show");
        var dloadingRecords     = __("Loading...");
        var dprocessing         = __("Processing...");
        var dsearch             = __("Search:");
        var dzeroRecords        = __("No matching records found");
        var dlast               = __("Last");
        var dnext               = __("Next");
        var dprevious           = __("Previous");
</script>

<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>