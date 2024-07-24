
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

// Add DatePicker
if (typeof MCDatepicker !== 'undefined') {

    var end_input = document.getElementById('end_date');

    if (end_input) {
        // Get today's date
        const today = new Date();

        // Add 35 days to today's date
        const minDate = new Date(today.getTime());

        // Store selected startDate
        let startDate = today;

        // Helper to calculate initial max
        function calculateMaxDate(startDate) {
            return new Date(startDate.getTime() + (35 * 24 * 60 * 60 * 1000));
        }

        // Set common defaults
        const baseSettings = {
            bodyType: 'modal',
            minDate: minDate,
            theme: {
                theme_color: '#6464f0'
            }
        }

        let endDatePicker = MCDatepicker.create({
            ...baseSettings,
            el: '#end_date',
            maxDate: calculateMaxDate(startDate),
        });

        var end_input = document.getElementById('end_date');
        if (end_input.value) {
            let dateParts = end_input.value.split("-");
            endDatePicker.setFullDate(new Date(dateParts[0], dateParts[1] - 1, dateParts[2]));
        }
        // Dispatch input event to update Livewire component
        endDatePicker.onSelect(date => {
            var input = document.getElementById('end_date');
            input.value = `${date.getFullYear()}-${("0" + (date.getMonth() + 1)).slice(-2)}-${("0" + date.getDate()).slice(-2)}`;
            input.dispatchEvent(new Event('input'));
        });
    }
}

// Show scam warning banner if first visit
window.onload = function() {
    var closeButton = document.getElementById('close-scam-warning');
    var banner = document.getElementById('scam-warning');
    if (banner && closeButton) {
        // Hide the banner
        if (!document.cookie.split('; ').find(row => row.startsWith('has_seen_banner='))) {
            // The cookie is not set, show the banner
            banner.classList.remove('hidden');
            closeButton.addEventListener('click', function() {
                // Hide the banner
                banner.classList.add('hidden');
                // Set the cookie
                var date = new Date();
                date.setFullYear(date.getFullYear() + 1); // Cookie will expire in 1 year
                document.cookie = 'has_seen_banner=true; expires=' + date.toUTCString() + '; path=/';
            });
        }
    }
}

// Load the tab on link with anchor
document.addEventListener('DOMContentLoaded', () => {
    // Get anchor link from URL
    const anchor = window.location.hash;
    // Check if anchor link exists
    if (anchor) {
        const tabButtons = document.querySelectorAll('.tab-panel-label');
        const tabPanels = document.querySelectorAll('.tab-panel');
        if (tabButtons && tabPanels) {
            // Remove # from anchor
            const tabId = anchor.substring(1);
            // Get tab link and tab elements
            const tabLink = document.getElementById(tabId + '-label');
            const targetPanel = document.getElementById(tabId);
            // Toggle classes on target panel
            tabPanels.forEach(panel => {
                panel.classList.add('hidden');
            })
            targetPanel.classList.remove('hidden');
            tabButtons.forEach(panel => {
                panel.classList.remove('active');
            })
            tabLink.classList.add('active');
            history.replaceState(null, null, ' ');
        }
    }
});

// Wait for DOM to load before querying elements
/*
//Appears to now work, leaving just in case.
document.addEventListener('DOMContentLoaded', () => {

    // Get elements
    const tabButtons = document.querySelectorAll('.tab-panel-label')
    const tabPanels = document.querySelectorAll('.tab-panel')

    // Attach click handlers
    tabButtons.forEach(button => {
        button.addEventListener('click', event => {
            // Get target tab panel ID
            const targetPanelId = event.currentTarget.getAttribute('data-hs-tab');
            // Get target panel element
            const targetPanel = document.querySelector(targetPanelId);
            // Toggle classes on target panel
            tabPanels.forEach(panel => {
                panel.classList.add('hidden');
            })
            targetPanel.classList.remove('hidden');
            tabButtons.forEach(panel => {
                panel.classList.remove('active');
            })
            button.classList.add('active');
        })
    })

})
*/

// Add Vido Upload manager
document.addEventListener("DOMContentLoaded", function() {

    const videoForm = document.getElementById('resume-video-form');
    if (videoForm !== null) {

        const restartButton = document.querySelector('#restart');
        if (restartButton !== null) {
            restartButton.addEventListener('click', function() {
                restartBtnClick();
            });
        }

        const previewButton = document.querySelector('#preview');
        if (previewButton !== null) {
            previewButton.addEventListener('click', function() {
                previewBtnClick();
            });
        }

        var video = document.querySelector("video");
        var recorder; // globally accessible
        var seconds = 60;
        var timerInterval;
        var timerCounterInterval;

        var TIMER_START_VALUE = 60;
        var timerCounter = TIMER_START_VALUE;

        // video btns
        const startBtn = document.getElementById("btn-start-recording");
        const stopBtn = document.getElementById("btn-stop-recording");
        const uploadBtn = document.getElementById("save-to-disk");
        const restartBtn = document.getElementById("restart");
        const previewBtn = document.getElementById("preview");
        const timer = document.getElementById("videoLength");
        const success = document.getElementById("success-text");
        const error = document.getElementById("error-text");

        let recordedVideo;

        // functions for video
        function captureCamera(callback) {
            navigator.mediaDevices
                .getUserMedia({
                    audio: true,
                    video: true,
                })
                .then(function (camera) {
                    callback(camera);
                })
                .catch(function (errorMsg) {
                    error.classList.remove("hidden");
                    error.innerHTML = errorMsg;
                });
        }

        function stopRecordingCallback() {
            pauseRecorderAtStop();
        }

        function pauseRecorderAtStop() {
            // get recorded blob
            var blob = recorder.getBlob();
            video.srcObject = null;
            recorder.camera.stop();
            video.src = URL.createObjectURL(blob);
            recordedVideo = blob;
        }

        function runMedia() {
            captureCamera(function (camera) {
                video.muted = true;
                video.volume = 0;
                video.srcObject = camera;

                recorder = RecordRTC(camera, {
                    recorderType: MediaStreamRecorder,
                    mimeType: "video/webm",
                    timeSlice: 1000, // pass this parameter
                });

                (function looper() {
                    if (!recorder) {
                        return;
                    }

                    var internal = recorder.getInternalRecorder();
                    if (internal && internal.getArrayOfBlobs) {
                        var blob = new Blob(internal.getArrayOfBlobs(), {
                            type: "video/webm",
                        });

                        // document.getElementById("videoLength").innerHTML =
                        //     "Length: " + bytesToSize(blob.size);
                    }

                    setTimeout(looper, 1000);
                })();


                recorder.startRecording();

                // release camera on stopRecording
                recorder.camera = camera;

                hideStartAndShowStopBtn();

                startTimerForVideo()
            });
        }

        function hideStartAndShowStopBtn() {
            // hide start btn
            startBtn.classList.add("hidden");
            // show stop btn
            stopBtn.classList.remove("hidden");
            stopBtn.disabled = false;

            // hide third step btn
            restartBtn.classList.add("hidden");
            previewBtn.classList.add("hidden");
            uploadBtn.classList.add("hidden");
        }

        function hideStopAndShowUploadStepBtn() {
            clearTimeout(timerInterval);
            // hide stop btn
            stopBtn.classList.add("hidden");

            // show upload btn
            restartBtn.classList.remove("hidden");
            previewBtn.classList.remove("hidden");
            uploadBtn.classList.remove("hidden");
            // uploadBtn.disabled = false;
        }

        function showStartBtn () {
            startBtn.classList.remove("hidden");
            startBtn.disabled = false;
            stopBtn.classList.add("hidden");
            stopBtn.disabled = false;
            restartBtn.classList.add("hidden");
            previewBtn.classList.add("hidden");
            uploadBtn.classList.add("hidden");
        }

        function startTimerForVideo() {
            // automatic stops the recorder
            var milliSeconds = seconds * 1000;
            timerInterval = setTimeout(function () {
                // stop recording
                recorder.stopRecording(stopRecordingCallback)
                hideStopAndShowUploadStepBtn();
            }, milliSeconds);
        }

        // start btn clicked
        startBtn.onclick = function () {
            this.disabled = true;
            runTimerCounterInterval()
            runMedia();
        };

        // stop btn clicked
        stopBtn.onclick = function () {
            this.disabled = true;
            stopTimerCounter();
            recorder.stopRecording(stopRecordingCallback);
            hideStopAndShowUploadStepBtn();
        };

        function restartBtnClick() {;
            recorder.reset();
            timerCounter = TIMER_START_VALUE;
            timer.classList.remove("hidden");
            timer.innerHTML = "Timer in seconds: " + timerCounter;
            showStartBtn();
        }

        function previewBtnClick() {
            var recordedBlob = recorder.getBlob();
            var videoUrl = URL.createObjectURL(recordedBlob);

            // Open the video in a new window
            var previewWindow = window.open(videoUrl, "_blank");
            previewWindow.focus();
        }

        var form = document.querySelector("form");
        // upload to server
        uploadBtn.onclick = function () {
            const recordedBlob = recordedVideo;

            // generating a random file name
            var fileName = getFileName("webm");

            // we need to upload "File" --- not "Blob"
            var fileObject = new File([recordedBlob], fileName, {
                type: "video/webm",
            });

            // downloadLink();

            let userId = document.querySelector('meta[name="user-id"]').getAttribute('content');
            let signedRoute = document.querySelector('meta[name="signed-route"]').getAttribute('content');
            var formData = new FormData();
            // recorded data
            formData.append("video-blob", fileObject);
            // file name
            formData.append("video-filename", fileObject.name);
            formData.append("user-id", userId);

            fetch(signedRoute, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    success.classList.remove("hidden");
                    success.innerHTML = "Your video has been saved successfully. You can view it here: <a class=\"text-cerise-red-500\" href='" + data.message + "'>here</a>";
                } else {
                    error.classList.remove("hidden");
                    error.innerHTML = "File upload error: " + data.message;
                }
            })
            .catch((errorMsg) => {
                error.classList.remove("hidden");
                error.innerHTML = "File upload error: " + errorMsg.message;
            });

            // release camera
            // video.srcObject = video.src = null;
            recorder.camera.getTracks().forEach(function (track) {
                track.stop();
            });


            function downloadLink() {
                // Create a download link for the video file
                var downloadLink = document.createElement('a');
                downloadLink.href = URL.createObjectURL(fileObject);
                downloadLink.download = fileObject.name;

                // Append the download link to the document body
                document.body.appendChild(downloadLink);

                // Trigger the download by simulating a click event
                downloadLink.click();

                // Clean up by removing the download link from the document body
                document.body.removeChild(downloadLink);
            }

            // this function is used to generate random file name
            function getFileName(fileExtension) {
                var d = new Date();
                var year = d.getUTCFullYear();
                var month = d.getUTCMonth();
                var date = d.getUTCDate();
                return (
                    "RecordRTC-" +
                    year +
                    month +
                    date +
                    "-" +
                    getRandomString() +
                    "." +
                    fileExtension
                );
            }

            function getRandomString() {
                if (
                    window.crypto &&
                    window.crypto.getRandomValues &&
                    navigator.userAgent.indexOf("Safari") === -1
                ) {
                    var a = window.crypto.getRandomValues(new Uint32Array(3)),
                        token = "";
                    for (var i = 0, l = a.length; i < l; i++) {
                        token += a[i].toString(36);
                    }
                    return token;
                } else {
                    return (Math.random() * new Date().getTime())
                        .toString(36)
                        .replace(/\./g, "");
                }
            }
        };

        function startTimerCounter() {
            if (timerCounter <= TIMER_START_VALUE && timerCounter !== 0) {
                // timerCounter += 1;
                timerCounter -= 1;
                timer.classList.remove("hidden");
                timer.innerHTML = "Timer in seconds: " + timerCounter;
            } else {
                stopTimerCounter();
            }
        }

        function stopTimerCounter() {
            clearInterval(timerCounterInterval);
            timer.classList.add("hidden");
        }

        function runTimerCounterInterval() {
            timerCounterInterval = setInterval(startTimerCounter, 1000);
        }
    }
});