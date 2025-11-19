{{-- <div
    x-data="{
        chart: null,
        init() {
            const ctx = this.$refs.canvas.getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(37, 99, 235, 0.4)'); // Blue-500
            gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

            this.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @js($labels),
                    datasets: [{
                        label: 'Premises Growth',
                        data: @js($data),
                        borderColor: 'rgba(37, 99, 235, 1)',
                        backgroundColor: gradient,
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(37, 99, 235, 1)',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    }"
    class="relative w-full h-64"
>
    <canvas x-ref="canvas" class="w-full h-full"></canvas>
</div> --}}

<div
    x-data="{
        chart: null,
        init() {
            const ctx = this.$refs.canvas.getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(37, 99, 235, 0.4)');
            gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

            this.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @js($labels),
                    datasets: [{
                        label: 'Premises Growth',
                        data: @js($data),
                        borderColor: 'rgba(37, 99, 235, 1)',
                        backgroundColor: gradient,
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(37, 99, 235, 1)',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true },
                    },
                    scales: {
                        x: {
                            ticks: {
                                autoSkip: true,
                                maxRotation: 45,  // Better for date labels
                                minRotation: 20,
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    }"
    class="relative w-full h-64"
>
    <canvas x-ref="canvas" class="w-full h-full"></canvas>
</div>

