<footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">Softliee</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>
  <!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}" ></script>
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}" ></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}" ></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}" ></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}" ></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- overlayScrollbars -->
{{-- <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}" ></script> --}}
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}" ></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}" ></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}" ></script>
{{-- @endsection --}}
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script>
  //Initialize Select2 Elements
  $('.select2').select2()
  //Initialize elect2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>