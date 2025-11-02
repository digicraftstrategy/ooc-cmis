<div
    x-data="{
        chart: null,
        init() {
            const ctx = this.$refs.canvas.getContext('2d');
            this.chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @js($labels),
                    datasets: [{
                        label: 'Applications',
                        data: @js($data),
                        backgroundColor: 'rgba(79, 70, 229, 0.6)', // indigo-600
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 1,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
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
</div>
