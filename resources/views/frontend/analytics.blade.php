@extends('frontend.rcms.layout.main_rcms')

<script>
    // Function to update the options of the second dropdown based on the selection in the first dropdown
    function updateQueryOptions() {
        var scopeSelect = document.getElementById('scope');
        var querySelect = document.getElementById('query');
        var scopeValue = scopeSelect.value;

        // Clear existing options in the query dropdown
        querySelect.innerHTML = '';

        // Add options based on the selected scope
        if (scopeValue === 'external_audit') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Audit Preparation', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Pending Response', '4'));
            querySelect.options.add(new Option('CAPA Execution in Progress', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));


        } else if (scopeValue === 'internal_audit') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Audit Preparation', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Pending Response', '4'));
            querySelect.options.add(new Option('CAPA Execution in Progress', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));

        } else if (scopeValue === 'capa') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending CAPA Plan', '2'));
            querySelect.options.add(new Option('CAPA In Progress', '3'));
            querySelect.options.add(new Option('Pending Approval', '4'));
            querySelect.options.add(new Option('Pending Actions Completion', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));

        } else if (scopeValue === 'audit_program') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Approval', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Closed - Done', '4'));

        } else if (scopeValue === 'lab_incident') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Incident Review ', '2'));
            querySelect.options.add(new Option('Pending Investigation', '3'));
            querySelect.options.add(new Option('Pending Activity Completion', '4'));
            querySelect.options.add(new Option('Pending CAPA', '5'));
            querySelect.options.add(new Option('Pending QA Review', '6'));
            querySelect.options.add(new Option('Pending QA Head Approve', '7'));
            querySelect.options.add(new Option('Close - Done', '8'));

        } else if (scopeValue === 'risk_assement') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Risk Analysis & Work Group Assignment', '2'));
            querySelect.options.add(new Option('Risk Processing & Action Plan', '3'));
            querySelect.options.add(new Option('Pending HOD Approval ', '4'));
            querySelect.options.add(new Option('Actions Items in Progress', '5'));
            querySelect.options.add(new Option('Residual Risk Evaluation', '6'));
            querySelect.options.add(new Option('Close - Done', '7'));

        } else if (scopeValue === 'root_cause_analysis') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Investigation in Progress', '2'));
            querySelect.options.add(new Option('Pending Group Review Discussion', '3'));
            querySelect.options.add(new Option('Pending Group Review', '4'));
            querySelect.options.add(new Option('Pending QA Review', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));

        } else if (scopeValue === 'management_review') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('In Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'extension') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Approval', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'documents') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Close - Cancel', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'observation') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending CAPA Plan', '2'));
            querySelect.options.add(new Option('Pending Approval', '3'));
            querySelect.options.add(new Option('Pending Final Approval', '4'));
            querySelect.options.add(new Option('Close - Done', '5'));
        } else if (scopeValue === 'action_item') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Work in Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'effectiveness_check') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Check Effectiveness', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'CC') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        }


        // Add more conditions based on other scope values

    }
</script>
@section('rcms_container')
<div id="rcms-dashboard">
    <div class="container-fluid">
        <div class="dash-grid">

            <div>
                <div class="inner-block scope-table" style="height: calc(100vh - 170px); padding: 0;">

                    <div class="grid-block">
                        <div class="group-input">
                            <label for="scope">Process</label>
                            <select id="test" onchange="showChart(null)">
                                <option value="">All Records</option>
                                {{-- <option value="Internal-Audit">Internal Audit</option>
                                <option value="External-Audit">External Audit</option> --}}
                                <option value="Capa">CAPA</option>
                                {{-- <option value="Audit-Program">Audit Program</option>
                                <option value="Lab Incident">Lab Incident</option>
                                <option value="Risk Assesment">Risk Assesment</option> --}}
                                <option value="Root-Cause-Analysis">Root Cause Analysis</option>
                                <option value="Management Review">Management Review</option>
                                {{-- <option value="Document">Document</option>
                                <option value="Extension">Extension</option>
                                <option value="Observation">Observation</option>
                                <option value="Change Control">Change Control</option>
                                <option value="Action Item">Action Item</option> --}}
                                <option value="Effectiveness Check">Effectiveness Check</option>
                                <option value="Deviation">Deviation</option>
                                {{-- <option value="tms">TMS</option>  --}}
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="query">Chart Type</label>
                            <select id="query" name="stage">
                                <option onclick="showChart('bar')" value="bar">Bar Chart</option>
                                <option onclick="showChart('pie')" value="pie">Pie Chart</option>
                                <option onclick="showChart('line')" value="line">Line Chart</option>
                                {{-- <option value="4">Overdue Records</option>
                                    <option value="Assigned">Assigned To Me</option>
                                    <option value="Records">Records Created Today</option> --}}
                            </select>
                        </div>
                        <div class="item-btn" onclick="window.print()">Print</div>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}


                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


                    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

                    <div class="main-scope-table">
                        <div>
                            <button id="toggleChartButton">Bar Chart</button>
                            <canvas id="myChart" width="400" height="115"></canvas>
                            <canvas id="myLineChart" width="400" height="115" style="display:none;"></canvas>
                            <div id="paichart" style="width: 400px; height: 115px; margin: 0 auto; display:none;">
                            </div>
                        </div>

                        <script>
                            var chartTypes = ['bar', 'pie', 'line']; // Available chart types
                            var currentChartIndex = 0; // Index to track the current chart type



                            function toggleCharts() {
                                currentChartIndex = (currentChartIndex + 1) % chartTypes.length; // Cycle through chart types
                                var chartType = chartTypes[currentChartIndex];
                                var button = document.getElementById('toggleChartButton');

                                if (chartType === 'bar') {
                                    button.textContent = 'Bar Chart';
                                    document.getElementById('myChart').style.display = 'block';
                                    document.getElementById('myLineChart').style.display = 'none';
                                    document.getElementById('paichart').style.display = 'none';
                                } else if (chartType === 'pie') {
                                    button.textContent = 'Pie Chart';
                                    document.getElementById('myChart').style.display = 'none';
                                    document.getElementById('myLineChart').style.display = 'none';
                                    document.getElementById('paichart').style.display = 'block';
                                } else if (chartType === 'line') {
                                    button.textContent = 'Line Chart';
                                    document.getElementById('myChart').style.display = 'none';
                                    document.getElementById('myLineChart').style.display = 'block';
                                    document.getElementById('paichart').style.display = 'none';
                                }
                            }

                            document.getElementById('toggleChartButton').addEventListener('click', toggleCharts);
                        </script>


                        <script>
                            axios.get('/api/analyticsData')
                                .then(function(response) {
                                    var dataCounts = response.data;

                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['InternalAudit', 'Extension', 'Capa', 'AuditProgram', 'LabIncident',
                                                'RiskManagement', 'RootCauseAnalysis', 'ManagementReview', 'CC', 'ActionItem',
                                                'EffectivenessCheck', 'Auditee', 'Observation'
                                            ],
                                            datasets: [{
                                                label: '',
                                                data: dataCounts,
                                                backgroundColor: [
                                                    'rgba(75, 192, 192, 0.27)',
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)',
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(75, 192, 192, 0.27)',
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)',
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                });
                        </script>

                        <script>
                            axios.get('/api/analyticsData')
                                .then(function(response) {
                                    var dataCountsdata = response.data;

                                    var options = {
                                        series: dataCountsdata,
                                        chart: {
                                            width: 380,
                                            type: 'pie',
                                        },
                                        labels: ['InternalAudit', 'Extension', 'Capa', 'AuditProgram', 'LabIncident', 'RiskManagement',
                                            'RootCauseAnalysis', 'ManagementReview', 'CC', 'ActionItem', 'EffectivenessCheck',
                                            'Auditee',
                                            'Observation'
                                        ],
                                        legend: {
                                            position: 'bottom',
                                            offsetY: 10, // adjust this value if needed
                                            height: 50 // adjust this value if needed
                                        },
                                        responsive: [{
                                            breakpoint: 480,
                                            options: {
                                                chart: {
                                                    width: 200
                                                },
                                                legend: {
                                                    position: 'bottom'
                                                }
                                            }
                                        }]
                                    };

                                    var chart = new ApexCharts(document.querySelector("#paichart"), options);
                                    chart.render();
                                })
                        </script>
                        <script type="text/javascript">
                            axios.get('/api/analyticsData')
                                .then(function(response) {
                                    var dataCounts = response.data;
                                    var labelsLine = ['InternalAudit', 'Extension', 'Capa', 'AuditProgram', 'LabIncident', 'RiskManagement',
                                        'RootCauseAnalysis', 'ManagementReview', 'CC', 'ActionItem', 'EffectivenessCheck', 'Auditee',
                                        'Observation'
                                    ];
                                    var users = [65, 59, 80, 81, 56, 55, 40];
                                    const dataLine = {
                                        labels: labelsLine,
                                        datasets: [{
                                            label: '',
                                            backgroundColor: 'rgb(255, 99, 132)',
                                            borderColor: 'rgb(255, 99, 132)',
                                            data: dataCounts,
                                        }]
                                    };
                                    const configLine = {
                                        type: 'line',
                                        data: dataLine,
                                        options: {}
                                    };
                                    const myChartLine = new Chart(
                                        document.getElementById('myLineChart'),
                                        configLine
                                    );
                                });
                        </script>
                        <div id="test">
                            </br>
                            <hr>
                            </br>
                            <h4 align="center" id="selectedValueText"></h4>
                            <div id="chart1"></div>
                            <h4 align="center" id="selectedValueTextDepartment"></h4>
                            <div id="chart2"></div>
                            <h4 align="center" id="selectedValueTextDepartmentReleted"></h4>
                            <div id="chart3"></div>
                            <h4 align="center" id="selectedValueTextInitialDeviationCategory"></h4>
                            <div id="chart4"></div>
                            <h4 align="center" id="selectedValueTextPostCategorizationOfDeviation"></h4>
                            <div id="chart5"></div>
                            <h4 align="center" id="selectedValueTextCAPARequired"></h4>
                            <div id="chart6"></div>
                            <h4 align="center" id="selectedValueTextCAPARequiredRCA"></h4>
                            <div id="chart7"></div>
                        </div>
                        <hr>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <h4 align="center">Due Date</h4>
                        <canvas id="myChartDue" width="400" height="115"></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
                        <script>
                            axios.get('/api/analyticsData?value=due')
                                .then(function(response) {
                                    var dataCountsDue = response.data;


                                    var ctx = document.getElementById('myChartDue').getContext('2d');
                                    var myChartDue = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['InternalAudit', 'Extension', 'Capa', 'AuditProgram', 'LabIncident',
                                                'RiskManagement', 'RootCauseAnalysis', 'ManagementReview', 'CC', 'ActionItem',
                                                'EffectivenessCheck', 'Auditee', 'Observation'
                                            ],
                                            datasets: [{
                                                label: '',
                                                data: dataCountsDue,
                                                backgroundColor: [
                                                    'rgba(75, 192, 192, 0.27)',
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)',
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(75, 192, 192, 0.27)',
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)',
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                })
                        </script>
                        {{-- <div class="scope-pagination">
                            {{ $datag->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-sm" id="record-modal">
    <div class="modal-contain">
        <div class="modal-dialog m-0">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body " id="auditTableinfo">
                    Please wait...
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function showChild() {
        $(".child-row").toggle();
    }

    $(".view-list").hide();

    function toggleview() {
        $(".view-list").toggle();
    }

    $("#record-modal .drop-list").hide();

    function showAction() {
        $("#record-modal .drop-list").toggle();
    }
</script>
<script type='text/javascript'>
    $(document).ready(function() {
        $('#auditTable').on('click', '.viewdetails', function() {
            var auditid = $(this).attr('data-id');
            var formType = $(this).attr('data-type');
            if (auditid > 0) {
                // AJAX request
                var url = "{{ route('ccView', ['id' => ':auditid', 'type' => ':formType']) }}";
                url = url.replace(':auditid', auditid).replace(':formType', formType);

                // Empty modal data
                $('#auditTableinfo').empty();
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(response) {
                        // Add employee details
                        $('#auditTableinfo').append(response.html);
                        // Display Modal
                        $('#record-modal').modal('show');
                    }
                });
            }
        });
    });
</script>
<script>
    function showChart(chartType) {
        var selectElement = document.getElementById("test");
        var chartDiv = document.getElementById("chart1");

        // Hide the chart if no option is selected
        if (!selectElement.value) {
            chartDiv.style.display = "none";
            return;
        } else {
            chartDiv.style.display = "block";
        }

        // Clear the existing chart data
        var chartElement = document.querySelector("#chart");
        if (chartElement) {
            chartElement.innerHTML = ""; // Clear the chart container
        }
        var selectedValue = selectElement.value;
        document.getElementById("selectedValueText").textContent = selectedValue + " (Division)";
        document.getElementById("selectedValueTextDepartment").textContent = selectedValue + " (Department)";
        document.getElementById("selectedValueTextDepartmentReleted").textContent = selectedValue + " (Related To)";
        document.getElementById("selectedValueTextInitialDeviationCategory").textContent = selectedValue + " (Initial Deviation Category)";
        document.getElementById("selectedValueTextPostCategorizationOfDeviation").textContent = selectedValue + " (Post Categorization Of Deviation)";
        document.getElementById("selectedValueTextCAPARequired").textContent = selectedValue + " (CAPA Required)";
        document.getElementById("selectedValueTextCAPARequiredRCA").textContent = selectedValue + " (RCA)";
        fetchData(selectedValue, chartType);
    }
</script>

<script>
    let chart1;
    let chart2;
    let chart3;
    let chart4;
    let chart5;
    let chart6;
    let chart7;

    function fetchData(selectedValue, chartType) {
        let currentChartType = chartType == null ? 'bar' : chartType;

        fetch(`/chart-data?value=${selectedValue}`)
            .then(response => response.json())
            .then(data => {
                if (currentChartType === 'pie') {
                    renderPieChart(data);
                } else if (currentChartType === 'bar') {
                    renderBarChart(data);
                } else if (currentChartType === 'line') {
                    renderLineChart(data);
                }
            });
        fetch(`/chart-data-dep?value=${selectedValue}`)
            .then(response => response.json())
            .then(data => {
                if (currentChartType === 'pie') {
                    renderSecondPieChart(data);
                } else if (currentChartType === 'bar') {
                    renderSecondBarChart(data);
                } else if (currentChartType === 'line') {
                    renderSecondLineChart(data);
                }
            });

        fetch(`/chart-data-releted?value=${selectedValue}`)
            .then(response => response.json())
            .then(data => {
                if (currentChartType === 'pie') {
                    renderThirdPieChart(data);
                } else if (currentChartType === 'bar') {
                    renderThirdBarChart(data);
                } else if (currentChartType === 'line') {
                    renderThirdLineChart(data);
                }
            });

        fetch(`/chart-data-initialDeviationCategory?value=${selectedValue}`)
            .then(response => response.json())
            .then(data => {
                if (currentChartType === 'pie') {
                    renderFourthPieChart(data);
                } else if (currentChartType === 'bar') {
                    renderFourthBarChart(data);
                } else if (currentChartType === 'line') {
                    renderFourthLineChart(data);
                }
            });

        fetch(`/chart-data-postCategorizationOfDeviation?value=${selectedValue}`)
            .then(response => response.json())
            .then(data => {
                if (currentChartType === 'pie') {
                    renderFifthPieChart(data);
                } else if (currentChartType === 'bar') {
                    renderFifthBarChart(data);
                } else if (currentChartType === 'line') {
                    renderFifthLineChart(data);
                }
            });

        fetch(`/chart-data-capa?value=${selectedValue}`)
            .then(response => response.json())
            .then(data => {
                if (currentChartType === 'pie') {
                    renderSixPieChart(data);
                } else if (currentChartType === 'bar') {
                    renderSixBarChart(data);
                } else if (currentChartType === 'line') {
                    renderSixLineChart(data);
                }
            });

            fetch(`/chart-data-statuswise?value=${selectedValue}`)
            .then(response => response.json())
            .then(data => {
                if (currentChartType === 'pie') {
                    renderSevenPieChart(data);
                } else if (currentChartType === 'bar') {
                    renderSevenBarChart(data);
                } else if (currentChartType === 'line') {
                    renderSevenLineChart(data);
                }
            });

    }

    function renderPieChart(data) {
        var options = {
            series: data.map(item => item.value),
            labels: data.map(item => item.division),
            chart: {
                type: 'pie',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    offsetX: 0,
                    offsetY: 0,
                    dataLabels: {
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        // Check if chart exists and destroy
        if (chart1) {
            chart1.destroy();
        }
        // Initialize a new chart
        chart1 = new ApexCharts(document.querySelector("#chart1"), options);
        chart1.render();
    }

    function renderBarChart(data) {
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart1) {
            chart1.destroy();
        }

        // Initialize a new chart
        chart1 = new ApexCharts(document.querySelector("#chart1"), options);
        chart1.render();
    }

    function renderLineChart(data) {
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart1) {
            chart1.destroy();
        }

        // Initialize a new chart
        chart1 = new ApexCharts(document.querySelector("#chart1"), options);
        chart1.render();
    }

    function renderSecondPieChart(data) {
        console.log('pie');
        var options = {
            series: data.map(item => item.value),
            labels: data.map(item => item.division),
            chart: {
                type: 'pie',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    offsetX: 0,
                    offsetY: 0,
                    dataLabels: {
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };


        if (chart2) {
            chart2.destroy();
        }

        // Initialize a new chart
        chart2 = new ApexCharts(document.querySelector("#chart2"), options);
        chart2.render();
    }

    function renderSecondBarChart(data) {
        console.log('bar');
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart2) {
            chart2.destroy();
        }

        // Initialize a new chart
        chart2 = new ApexCharts(document.querySelector("#chart2"), options);
        chart2.render();
    }

    function renderSecondLineChart(data) {
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart2) {
            chart2.destroy();
        }

        // Initialize a new chart
        chart2 = new ApexCharts(document.querySelector("#chart"), options);
        chart2.render();
    }


    function renderThirdPieChart(data) {
        console.log('pie', data);
        var options = {
            series: data.map(item => item.value),
            labels: data.map(item => item.division),
            chart: {
                type: 'pie',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    offsetX: 0,
                    offsetY: 0,
                    dataLabels: {
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };


        if (chart3) {
            chart3.destroy();
        }

        // Initialize a new chart
        chart3 = new ApexCharts(document.querySelector("#chart3"), options);
        chart3.render();
    }

    function renderThirdBarChart(data) {
        console.log('bar3', data);
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart3) {
            chart3.destroy();
        }

        // Initialize a new chart
        chart3 = new ApexCharts(document.querySelector("#chart3"), options);
        chart3.render();
    }

    function renderThirdLineChart(data) {
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart3) {
            chart3.destroy();
        }

        // Initialize a new chart
        chart3 = new ApexCharts(document.querySelector("#chart3"), options);
        chart3.render();
    }

    function renderFourthPieChart(data) {
        console.log('pie', data);
        var options = {
            series: data.map(item => item.value),
            labels: data.map(item => item.division),
            chart: {
                type: 'pie',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    offsetX: 0,
                    offsetY: 0,
                    dataLabels: {
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };


        if (chart4) {
            chart4.destroy();
        }

        // Initialize a new chart
        chart4 = new ApexCharts(document.querySelector("#chart4"), options);
        chart4.render();
    }

    function renderFourthBarChart(data) {
        console.log('bar3', data);
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart4) {
            chart4.destroy();
        }

        // Initialize a new chart
        chart4 = new ApexCharts(document.querySelector("#chart4"), options);
        chart4.render();
    }

    function renderFourthLineChart(data) {
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart4) {
            chart4.destroy();
        }

        // Initialize a new chart
        chart4 = new ApexCharts(document.querySelector("#chart4"), options);
        chart4.render();
    }

    function renderFifthPieChart(data) {
        console.log('pie', data);
        var options = {
            series: data.map(item => item.value),
            labels: data.map(item => item.division),
            chart: {
                type: 'pie',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    offsetX: 0,
                    offsetY: 0,
                    dataLabels: {
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };


        if (chart5) {
            chart5.destroy();
        }

        // Initialize a new chart
        chart5 = new ApexCharts(document.querySelector("#chart5"), options);
        chart5.render();
    }

    function renderFifthBarChart(data) {
        console.log('bar3', data);
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart5) {
            chart5.destroy();
        }

        // Initialize a new chart
        chart5 = new ApexCharts(document.querySelector("#chart5"), options);
        chart5.render();
    }

    function renderFifthLineChart(data) {
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart5) {
            chart5.destroy();
        }

        // Initialize a new chart
        chart5 = new ApexCharts(document.querySelector("#chart5"), options);
        chart5.render();
    }

    function renderSixPieChart(data) {
        console.log('pie', data);
        var options = {
            series: data.map(item => item.value),
            labels: data.map(item => item.division),
            chart: {
                type: 'pie',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    offsetX: 0,
                    offsetY: 0,
                    dataLabels: {
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };


        if (chart6) {
            chart6.destroy();
        }

        // Initialize a new chart
        chart6 = new ApexCharts(document.querySelector("#chart6"), options);
        chart6.render();
    }

    function renderSixBarChart(data) {
        console.log('bar3', data);
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart6) {
            chart6.destroy();
        }

        // Initialize a new chart
        chart6 = new ApexCharts(document.querySelector("#chart6"), options);
        chart6.render();
    }

    function renderSixLineChart(data) {
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart6) {
            chart6.destroy();
        }

        // Initialize a new chart
        chart6 = new ApexCharts(document.querySelector("#chart6"), options);
        chart6.render();
    }


    function renderSevenPieChart(data) {
        console.log('pie', data);
        var options = {
            series: data.map(item => item.value),
            labels: data.map(item => item.division),
            chart: {
                type: 'pie',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    offsetX: 0,
                    offsetY: 0,
                    dataLabels: {
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };


        if (chart7) {
            chart7.destroy();
        }

        // Initialize a new chart
        chart6 = new ApexCharts(document.querySelector("#chart7"), options);
        chart6.render();
    }

    function renderSevenBarChart(data) {
        console.log('bar3', data);
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart7) {
            chart7.destroy();
        }

        // Initialize a new chart
        chart7 = new ApexCharts(document.querySelector("#chart7"), options);
        chart7.render();
    }

    function renderSevenLineChart(data) {
        var options = {
            series: [{
                name: 'Total',
                data: data.map(item => item.value),
                // Define color for each category
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
            }],
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.division)
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };

        if (chart7) {
            chart7.destroy();
        }

        // Initialize a new chart
        chart7 = new ApexCharts(document.querySelector("#chart7"), options);
        chart7.render();
    }
</script>
<script>
    var options = {
        series: [{
            name: 'Opend',
            data: [44, 55, 22, 43]
        }, {
            name: 'Cancelled',
            data: [13, 8, 13, 27]
        }, {
            name: 'Testing C',
            data: [11, 15, 21, 14]
        }, {
            name: 'Complete D',
            data: [21, 13, 22, 8]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                dataLabels: {
                    total: {
                        enabled: true,
                        style: {
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
        },
        xaxis: {
            type: 'text',
            categories: ['KSA', 'Egypt', 'Estonia', 'Jordan', ],
        },
        legend: {
            position: 'right',
            offsetY: 40
        },
        fill: {
            opacity: 1
        }
    };

    var chart = new ApexCharts(document.querySelector("#new-chart-id"), options);
    chart.render();
</script>
<style>
    #chart {
        display: none;
        width: 50%;
        height: 100px;
        margin-top: 10px;
        margin-left: auto;
        margin-right: auto;
    }

    #new-chart-id {

        width: 50%;
        height: 100px;
        margin-top: 10px;
        /* margin-left: auto; */
        /* margin-right: auto; */
    }

    #paichart {
        display: none;
        /* Hide the pie chart initially */
    }

    #toggleChartButton {
        color: #bf5313;
        background: #e4e4f2;
    }
</style>
@endsection