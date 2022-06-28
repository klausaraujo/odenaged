<script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
<script src="<?=base_url()?>public/template/js/popper.min.js"></script>
<script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>

<script src="<?=base_url()?>public/template/js/jquery.appear.js"></script>

<script src="<?=base_url()?>public/template/js/countdown.min.js"></script>

<script src="<?=base_url()?>public/template/js/waypoints.min.js"></script>
<script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>

<script src="<?=base_url()?>public/template/js/wow.min.js"></script>

<script src="<?=base_url()?>public/template/js/apexcharts.js"></script>

<script src="<?=base_url()?>public/template/js/slick.min.js"></script>

<script src="<?=base_url()?>public/template/js/select2.min.js"></script>

<script src="<?=base_url()?>public/template/js/owl.carousel.min.js"></script>

<script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>

<script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>

<script src="<?=base_url()?>public/template/js/lottie.js"></script>

<script src="<?=base_url()?>public/template/js/chart-custom.js"></script>

<script src="<?=base_url()?>public/template/js/custom.js"></script>
<script src="<?=base_url()?>public/js/echarts-en.min.js"></script>

<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>

<script src="<?=base_url()?>public/js/circles.js"></script>
<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url()?>public/js/Chart.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/dataTables.rowsGroup.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/jszip.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/pdfmake.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/vfs_fonts.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/template/js/datatable/buttons.colVis.min.js"></script>
<script>
    var languageDatatable = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copyTitle": 'Informacion copiada',
        "copyKeys": 'Use your keyboard or menu to select the copy command',
        "copySuccess": {
            "_": '%d filas copiadas al portapapeles',
            "1": '1 fila copiada al portapapeles'
        },

        "pageLength": {
        "_": "Mostrar %d filas",
        "-1": "Mostrar Todo"
        }
    }
};
</script>

<script>
function createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId) {
  var iconMap = {
    info: "fa fa-info-circle",
    success: "fa fa-thumbs-up",
    warning: "fa fa-exclamation-triangle",
    danger: "fa ffa fa-exclamation-circle"
  };

  var iconAdded = false;

  var alertClasses = ["alert", "animated", "flipInX"];
  alertClasses.push("alert-" + severity.toLowerCase());

  if (dismissible) {
    alertClasses.push("alert-dismissible");
  }

  var msgIcon = $("<i />", {
    "class": iconMap[severity]
  });

  var msg = $("<div />", {
    "class": alertClasses.join(" ")
  });

  if (title) {
    var msgTitle = $("<h4 />", {
      html: title
    }).appendTo(msg);

    if(!iconAdded){
      msgTitle.prepend(msgIcon);
      iconAdded = true;
    }
  }

  if (summary) {
    var msgSummary = $("<strong />", {
      html: summary
    }).appendTo(msg);

    if(!iconAdded){
      msgSummary.prepend(msgIcon);
      iconAdded = true;
    }
  }

  if (details) {
    var msgDetails = $("<p />", {
      html: details
    }).appendTo(msg);

    if(!iconAdded){
      msgDetails.prepend(msgIcon);
      iconAdded = true;
    }
  }


  if (dismissible) {
    var msgClose = $("<span />", {
      "class": "close",
      "data-dismiss": "alert",
      html: "<i class='fa fa-times-circle'></i>"
    }).appendTo(msg);
  }

  $('#' + appendToId).prepend(msg);

  if(autoDismiss){
    setTimeout(function(){
      msg.addClass("flipOutX");
      setTimeout(function(){
        msg.remove();
      },1000);
    }, 5000);
  }
}
</script>


