<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var menuCart = document.getElementById('menu-cart');

    const CHECK_INTERVAL = 1 * 60 * 60 * 1000;
    // 1 * 60 * 60 * 1000; 1 JAM
    // 1 * 60 * 1000; 1 MENIT

    function requestLocationPermission() {
        location.reload();
    }

    function getDeviceInfo() {
        const userAgent = navigator.userAgent;

        let deviceInfo = {
            platform: navigator.platform,
            userAgent: userAgent,
            language: navigator.language,
            isMobile: /Mobi|Android/i.test(userAgent),
            isDesktop: !/Mobi|Android/i.test(userAgent),
            browser: getBrowser(userAgent),
            os: getOperatingSystem(userAgent)
        };

        return deviceInfo;
    }

    function getBrowser(userAgent) {
        if (userAgent.indexOf("Chrome") > -1) {
            return "Chrome";
        } else if (userAgent.indexOf("Firefox") > -1) {
            return "Firefox";
        } else if (userAgent.indexOf("Safari") > -1) {
            return "Safari";
        } else if (userAgent.indexOf("Edge") > -1) {
            return "Edge";
        } else if (userAgent.indexOf("MSIE") > -1 || userAgent.indexOf("Trident") > -1) {
            return "Internet Explorer";
        }
        return "Unknown";
    }

    function getOperatingSystem(userAgent) {
        if (userAgent.indexOf("Win") > -1) return "Windows";
        if (userAgent.indexOf("Mac") > -1) return "macOS";
        if (userAgent.indexOf("Android") > -1) return "Android";
        if (userAgent.indexOf("iOS") > -1 || userAgent.indexOf("iPhone") > -1 || userAgent.indexOf("iPad") > -1)
            return "iOS";
        return "Unknown OS";
    }

    function setCookie(name, value, years) {
        const d = new Date();
        d.setTime(d.getTime() + (years * 365 * 24 * 60 * 60 * 1000));
        const expires = "expires=" + d.toUTCString();
        document.cookie = `${name}=${value};${expires};path=/`;
    }

    function getIndonesiaTime() {
        const date = new Date();
        const indonesiaOffset = 7 * 60 * 60 * 1000;
        const indonesiaTime = new Date(date.getTime() + indonesiaOffset);
        return indonesiaTime.toISOString();
    }

    function getCookie(name) {
        const nameEq = name + "=";
        const ca = document.cookie.split(';');
        for (let c of ca) {
            c = c.trim();
            if (c.indexOf(nameEq) === 0) return c.substring(nameEq.length);
        }
        return "";
    }

    function checkAndHideMenuCart() {
        const deviceId = getCookie('device_id');
        const latitude = getCookie('latitude');
        const longitude = getCookie('longitude');

        if (!deviceId || !latitude || !longitude) {
            menuCart.style.display = 'none';
        }
    }

    async function checkLocationCookie() {
        const deviceId = getCookie('device_id');
        const latitude = getCookie('latitude');
        const longitude = getCookie('longitude');
        const locationTime = getCookie('locationTime');

        if (latitude && longitude && locationTime) {
            const currentTime = Date.parse(getIndonesiaTime());
            const storedTime = new Date(locationTime).getTime();
            if ((currentTime - storedTime) >= CHECK_INTERVAL) {
                if (deviceId) {
                    await updateLocationToAPI(deviceId, latitude, longitude);
                } else {
                    await fetchLocationFromAPI();
                }
            } else {
                console.log(`Latitude: ${latitude}, Longitude: ${longitude} (Dari Cookie)`);
            }
        } else {
            await fetchLocationFromAPI();
        }

        checkAndHideMenuCart();
    }

    async function fetchLocationFromAPI() {
        try {
            const position = await getLocationFromBrowser();

            if (position) {
                const deviceInfo = getDeviceInfo();
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const response = await fetch('/generated-location', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        lat: latitude,
                        long: longitude,
                        info: {
                            ...deviceInfo
                        },
                    }),
                });

                if (response.ok) {
                    const data = await response.json();
                    const deviceId = data.data.code;
                    setCookie('device_id', deviceId, 10);
                    setCookie("latitude", latitude, 10);
                    setCookie("longitude", longitude, 10);
                    setCookie("locationTime", getIndonesiaTime(), 10);
                }
            }
        } catch (error) {
            console.error("Error saat mengirim lokasi ke API:", error.message);
            showPermissionModal();
        }
    }

    async function updateLocationToAPI(deviceId, latitude, longitude) {
        try {
            const deviceInfo = getDeviceInfo();
            const response = await fetch('/generated-location-update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                },
                body: JSON.stringify({
                    code: deviceId,
                    latitude: latitude,
                    longitude: longitude,
                    info: {
                        ...deviceInfo
                    }
                }),
            });

            if (response.ok) {
                const data = await response.json();
                setCookie("locationTime", getIndonesiaTime(), 10);
            } else {
                console.error("Gagal memperbarui lokasi:", response.statusText);
            }
        } catch (error) {
            console.error("Error saat memperbarui lokasi:", error.message);
        }
    }

    function getLocationFromBrowser() {
        return new Promise((resolve, reject) => {
            if (navigator.geolocation) {
                navigator.permissions.query({
                    name: 'geolocation'
                }).then((permissionStatus) => {
                    if (permissionStatus.state === 'granted') {
                        navigator.geolocation.getCurrentPosition(resolve, reject, {
                            enableHighAccuracy: true,
                            maximumAge: 0,
                            timeout: 5000,
                        });
                    } else if (permissionStatus.state === 'prompt') {
                        showPermissionModal();
                        reject(new Error("Izin lokasi belum diberikan"));
                    } else {
                        showPermissionModal();
                        reject(new Error("Izin lokasi ditolak"));
                    }
                });
            } else {
                console.error("Geolocation tidak didukung oleh browser ini.");
                showPermissionModal();
                reject(new Error("Geolocation tidak didukung"));
            }
        });
    }

    function showPermissionModal() {
        const modal = new bootstrap.Modal(document.getElementById('permissionModal'));
        modal.show();
    }

    setInterval(checkLocationCookie, CHECK_INTERVAL);

    navigator.permissions.query({
        name: 'geolocation'
    }).then(function(permissionStatus) {
        if (permissionStatus.state === 'granted') {
            console.log('Berhasil Diizinkan...');
        } else if (permissionStatus.state === 'prompt') {
            console.log('Izin belum diberikan. Meminta izin...');
        } else {
            console.log('Izin ditolak');
            showPermissionModal();
        }
    }).catch(function(error) {
        console.error('Error saat memeriksa izin: ', error);
    });

    checkLocationCookie();
    checkAndHideMenuCart();

    document.getElementById('loginForm').addEventListener('submit', function (e) {
      e.preventDefault(); // Prevent form submission

      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      if (email && password) {
        alert('Login successful!');
      } else {
        alert('Please fill in all fields.');
      }
    });
</script>
