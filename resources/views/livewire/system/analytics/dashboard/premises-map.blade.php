{{-- resources/views/livewire/system/analytics/dashboard/premises-map.blade.php --}}

<div
    id="premises-map"
    wire:ignore
    class="relative w-full h-96 rounded-xl overflow-hidden"
></div>

<script>
    (function () {
        const markers = @js($markers);

        function initPremisesMap() {
            const mapElement = document.getElementById('premises-map');
            if (!mapElement) {
                console.error('Map element #premises-map not found.');
                return;
            }

            // Prevent double init if Livewire re-renders
            if (mapElement.dataset.initialized === 'true') {
                return;
            }
            mapElement.dataset.initialized = 'true';

            console.log('Premises markers from Livewire:', markers);

            // Center roughly on PNG
            const map = L.map(mapElement).setView([-6.5, 145.9], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            if (!Array.isArray(markers) || markers.length === 0) {
                console.warn('No markers to plot on map.');
                return;
            }

            markers.forEach(marker => {
                const m = L.marker([marker.lat, marker.lng]).addTo(map);
                m.bindPopup(
                    `<strong>${marker.province}</strong><br>${marker.total} premises`
                );
            });
        }

        function ensureLeafletLoaded() {
            // If Leaflet is already loaded, just init the map
            if (window.L) {
                initPremisesMap();
                return;
            }

            console.log('Leaflet not found, loading from CDN…');

            // Inject Leaflet CSS once
            if (!document.querySelector('link[data-leaflet]')) {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                link.setAttribute('data-leaflet', '1');
                document.head.appendChild(link);
            }

            // Inject Leaflet JS
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
            script.async = true;
            script.onload = () => {
                console.log('Leaflet JS loaded.');
                initPremisesMap();
            };
            script.onerror = () => {
                console.error('Failed to load Leaflet JS from CDN.');
            };
            document.head.appendChild(script);
        }

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            ensureLeafletLoaded();
        } else {
            window.addEventListener('DOMContentLoaded', ensureLeafletLoaded);
        }
    })();
</script>

{{-- resources/views/livewire/system/analytics/dashboard/premises-map.blade.php --}}

{{-- <div
    id="premises-map"
    wire:ignore
    class="relative w-full h-96 rounded-xl overflow-hidden"
></div>

<script>
    (function () {
        const markers = @js($markers);

        function initPremisesMap() {
            const mapElement = document.getElementById('premises-map');
            if (!mapElement) {
                console.error('Map element #premises-map not found.');
                return;
            }

            // Prevent duplicate initialization
            if (mapElement.dataset.initialized === 'true') {
                return;
            }
            mapElement.dataset.initialized = 'true';

            console.log('Premises markers from Livewire:', markers);

            const map = L.map(mapElement).setView([-6.5, 145.9], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            if (!Array.isArray(markers) || markers.length === 0) {
                console.warn('No markers to plot on map.');
                return;
            }

            markers.forEach(marker => {
                const m = L.marker([marker.lat, marker.lng]).addTo(map);

                // BUILD POPUP HTML WITH FULL PREMISES DETAILS
                let popupHtml = `
                    <div style="min-width: 220px;">
                        <strong>${marker.name}</strong><br>
                        <span>${marker.location ?? ''}</span><br>
                        <b>Province:</b> ${marker.province ?? 'N/A'}<br>
                        <b>Owner:</b> ${marker.owner_name ?? 'N/A'}
                `;

                if (marker.contact_person) {
                    popupHtml += `<br>Contact: ${marker.contact_person}`;
                }
                if (marker.telephone) {
                    popupHtml += `<br>Tel: ${marker.telephone}`;
                }
                if (marker.mobile) {
                    popupHtml += `<br>Mobile: ${marker.mobile}`;
                }

                popupHtml += `</div>`;

                m.bindPopup(popupHtml);

                // HOVER EFFECT
                m.on('mouseover', function () {
                    this.openPopup();
                });
                m.on('mouseout', function () {
                    this.closePopup();
                });
            });
        }

        function ensureLeafletLoaded() {
            if (window.L) {
                initPremisesMap();
                return;
            }

            console.log('Leaflet not found, loading from CDN…');

            // Load Leaflet CSS once
            if (!document.querySelector('link[data-leaflet]')) {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                link.setAttribute('data-leaflet', '1');
                document.head.appendChild(link);
            }

            // Load Leaflet JS
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
            script.async = true;
            script.onload = () => {
                console.log('Leaflet JS loaded.');
                initPremisesMap();
            };
            script.onerror = () => {
                console.error('Failed to load Leaflet JS from CDN.');
            };
            document.head.appendChild(script);
        }

        // init after DOM ready
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            ensureLeafletLoaded();
        } else {
            window.addEventListener('DOMContentLoaded', ensureLeafletLoaded);
        }
    })();
</script> --}}
