<!-- resources/views/scan.blade.php -->

@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Scan QR Code</div>

                <div class="card-body">
                    <video id="video" width="100%" height="auto" style="object-fit: cover;"></video>
                    <button id="scan-button" class="btn btn-primary mt-2">Scan QR Code</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/@zxing/library@latest"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const codeReader = new ZXing.BrowserQRCodeReader();
    const videoElement = document.getElementById('video');
    const scanButton = document.getElementById('scan-button');

    scanButton.addEventListener('click', () => {
        // Add a delay of 2 seconds (2000 milliseconds) before starting QR code scanning
        setTimeout(() => {
            codeReader.decodeFromVideoDevice(undefined, 'video', (result, err) => {
                if (result) {
                    console.log(result.text); // Output the scanned QR code content

                    // Extract the URL from the QR code content
                    const qrCodeUrl = result.text;

                    // Open the URL in a new tab or window
                    window.open(qrCodeUrl, '_blank');

                    // Optional: Send AJAX request to Laravel backend (if needed)
                    fetch('/process-scan', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ qrCodeContent: result.text })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Handle response from backend if needed
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
                /*if (err) {
                    console.error('Error decoding QR code:', err);
                    alert('Unable to scan QR code. Please try again.'); // Display error to user
                }*/
            });
        }, 2000); // 2000 milliseconds = 2 seconds delay
    });
});


</script>
@endsection
