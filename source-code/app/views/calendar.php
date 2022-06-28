<!DOCTYPE html>
<html id="locale" lang="<?= ACTIVE_LANG ?>">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="<?= $Settings->get("site_description") ?>">
      <meta name="keywords" content="<?= $Settings->get("site_keywords") ?>">

      <link rel="icon" href="<?= $Settings->get("logomark") ? $Settings->get("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">
      <link rel="shortcut icon" href="<?= $Settings->get("logomark") ? $Settings->get("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">
      <!-- Bootstrap core CSS     -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
      <link href="<?= APPURL."/assets/css/bootstrap-datepicker.css?v=".VERSION ?>" rel="stylesheet">
      <!--  Paper Dashboard core CSS    -->
      <link href="<?= APPURL."/assets/css/paper-dashboard.css?v=".VERSION ?>" rel="stylesheet"/>
      <!--  Datatables    -->
      <link href="<?= APPURL."/assets/plugin/datatables/css/dataTables.bootstrap.css?v=".VERSION ?>" rel="stylesheet"/>
      <!--  Fonts and icons     -->
      <link href="<?= APPURL."/assets/css/font-awesome.min.css?v=".VERSION ?>" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
      <link href="<?= APPURL."/assets/css/themify-icons.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/css/select2.min.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/plugin/datatables/css/buttons.dataTables.min.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/plugin/datatables/css/buttons.bootstrap.min.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/plugin/morris/morris.css?v=".VERSION ?>"  rel="stylesheet">
      <link href="<?= APPURL."/assets/plugin/fullcalendar2/main.css?v=".VERSION ?>"  rel="stylesheet">
      <title><?= $Settings->get("site_name"). " - ".$Settings->get("site_slogan") ?></title>
   </head>
   <body>
      <!-- left screen -->
      <?php 
         $Nav = new stdClass;
         $Nav->activeMenu = "calendar";
         require_once(APPPATH.'/views/fragments/navigation.fragment.php'); ?>
      <!-- END left screen -->


      <div class="main-panel"><!-- right screen -->


         <!-- top navigation bar -->
         <?php require_once(APPPATH.'/views/fragments/topbar.fragment.php'); ?>
         <!-- END top navigation bar -->


         <!-- content -->
         <?php require_once(APPPATH.'/views/fragments/calendar.fragment.php'); ?>
         <!-- END content -->
      </div><!-- end right screen -->


      <!-- footer -->
      <?php require_once(APPPATH.'/views/fragments/footer.fragment.php'); ?>
      <!-- END footer -->
      </div>


      <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
      <!-- general Script -->
      <?php require_once(APPPATH.'/views/fragments/script.fragment.php'); ?>
      <!-- End general script -->



      <!-- individual script --> 
      <script src="<?= APPURL."/assets/js/general.js?v=".VERSION ?>"></script>
      <script>

      document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('mycalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
               initialView: 'dayGridMonth',
               headerToolbar:{
                  left: 'title',
                  right: 'prev,next,timeGridDay,dayGridMonth'
               },
            locale: '<?= ACTIVE_LANG ?>',	
            eventSources: [
               
               {
                  url: "<?= APIURL."/calendar/income" ?>",
                  color: '#41D5E2',
                  textColor: 'white'
               },
               {
                  url: "<?= APIURL."/calendar/expense" ?>",
                  color: '#FF5668',
                  textColor: 'white'
               }
            ],
            eventContent: function(arg) {
            let italicEl = document.createElement('div')
               italicEl.innerHTML = '<div class="p-2">'+arg.event.title + '<br>' +currency+ arg.event.extendedProps.amount + '</div>';

            let arrayOfDomNodes = [ italicEl ]
               return { domNodes: arrayOfDomNodes }
            },
            eventDidMount: function(arg) {
               $(arg.el).tooltip({ 
                  title: arg.event.title + ' (' +currency+ arg.event.extendedProps.amount + ')',
                  placement: "top",
                  trigger: "hover",
                  container: "body"
                  });
               }
            });

               //reload data on click previous date
               var moment = calendar.getDate();
               var date   = moment.toISOString(); 
                  $.ajax({
                     type: "POST",
                        url: "<?= APIURL."/calendar/filterdate" ?>",
                        data: {date:date},
                        success: function(data) {
                                 $('#monthbalance').html(data.monthbalance);
                                 $('.monthname').html(data.monthname);
                                 $('#incomemonth').html(data.monthincome);
                                 $('#expensemonth').html(data.monthexpense);
                        }
                  });
               

               
            calendar.render();

            });





      </script>
      <!-- End individual script --> 

      
   </body>
</html>