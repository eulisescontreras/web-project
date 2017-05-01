            </main>
        </div>
        <!-- inject:js -->
        <script src="https://d3js.org/d3.v4.min.js"  charset="utf-8"></script>
        <script src="/assets/js/dashboard/getmdl-select.min.js"></script>
        <script src="/assets/js/dashboard/material.js"></script>
        <script src="/assets/js/dashboard/nv.d3.js"></script>
        <script src="/assets/js/dashboard/layout2.js"></script>
        <script src="/assets/js/dashboard/widgets/charts/chart1.js"></script>
        <script src="/assets/js/dashboard/widgets/charts/chart2.js"></script>
        <script src="/assets/js/dashboard/widgets/charts/discreteBarChart.js"></script>
        <script src="/assets/js/dashboard/widgets/employer-form/employer-form.js"></script>
        <script src="/assets/js/dashboard/widgets/line-chart/line-chart-nvd3.js"></script>
        <script src="/assets/js/dashboard/widgets/map/maps.js"></script>
        <script src="/assets/js/dashboard/widgets/pie-chart/pie-chart-nvd3.js"></script>
        <script src="/assets/js/dashboard/widgets/table/table.js"></script>
        <script src="/assets/js/dashboard/widgets/todo/todo.js"></script>
        <script src="/vendor/jquery/dist/jquery.min.js"></script>
        <!-- endinject -->
        <!-- authenticate:js -->
        <script>
            redirectSessionEnd();
            setInterval('redirectSessionEnd()',300000);
            function redirectSessionEnd(){
                $.ajax({
                    method: "POST",
                    url:   "<?php echo base_url(); ?>index.php/is_login",
                    dataType: 'json',
                    success: function(data){
                        if(data == null)
                            $(location).attr('href',"<?php echo base_url(); ?>");
                    }
                });
            }
             
        </script>
        <!-- authenticate:js -->
    </body>
</html>