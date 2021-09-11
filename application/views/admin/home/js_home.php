<script>
    $(document).ready(function(){
        try {
            // Percent Chart SMS
            var sent = document.getElementById("sent_sms").innerHTML;
            var not_sent = document.getElementById("not_sent_sms").innerHTML;
            var ctx = document.getElementById("percent-chart-sms");
                if (ctx) {
                ctx.height = 280;
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                    datasets: [
                        {
                        label: "SMS Report",
                        data: [sent, not_sent],
                        backgroundColor: [
                            '#00b5e9',
                            '#fa4251'
                        ],
                        hoverBackgroundColor: [
                            '#00b5e9',
                            '#fa4251'
                        ],
                        borderWidth: [
                            0, 0
                        ],
                        hoverBorderColor: [
                            'transparent',
                            'transparent'
                        ]
                        }
                    ],
                    labels: [
                        'Terkirim',
                        'Tidak Terkirim'
                    ]
                    },
                    options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    cutoutPercentage: 55,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleFontFamily: "Poppins",
                        xPadding: 15,
                        yPadding: 10,
                        caretPadding: 0,
                        bodyFontSize: 16
                    }
                    }
                });
                }

        } catch (error) {
            console.log(error);
        }

        try {
            // Percent Chart Click Grandsbmptn
            var click = document.getElementById("user_click").innerHTML;
            var not_click = document.getElementById("user_not_click").innerHTML;
            var ctx = document.getElementById("percent-chart-grandsbmptn");
                if (ctx) {
                ctx.height = 280;
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                    datasets: [
                        {
                        label: "Click Report",
                        data: [click, not_click],
                        backgroundColor: [
                            '#00b5e9',
                            '#fa4251'
                        ],
                        hoverBackgroundColor: [
                            '#00b5e9',
                            '#fa4251'
                        ],
                        borderWidth: [
                            0, 0
                        ],
                        hoverBorderColor: [
                            'transparent',
                            'transparent'
                        ]
                        }
                    ],
                    labels: [
                        'Klik',
                        'Tidak Klik'
                    ]
                    },
                    options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    cutoutPercentage: 55,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleFontFamily: "Poppins",
                        xPadding: 15,
                        yPadding: 10,
                        caretPadding: 0,
                        bodyFontSize: 16
                    }
                    }
                });
                }

        } catch (error) {
            console.log(error);
        }
    });

function total_user() {
    window.location.href = "<?php echo base_url(); ?>admin/download/excel/data-peserta/1";
}
function total_user_not_verified() {
    window.location.href = "<?php echo base_url(); ?>admin/download/excel/data-peserta/2";
}
function total_user_verified() {
    window.location.href = "<?php echo base_url(); ?>admin/download/excel/data-peserta/3";
}
function total_user_input_data() {
    window.location.href = "<?php echo base_url(); ?>admin/download/excel/data-peserta/4";
}
function total_user_click_data() {
    window.location.href = "<?php echo base_url(); ?>admin/download/excel/data-peserta/5";
}
function total_user_not_click_data() {
    window.location.href = "<?php echo base_url(); ?>admin/download/excel/data-peserta/6";
}
</script>