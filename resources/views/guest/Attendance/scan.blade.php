@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">QR Code Scanner</div>

                <div class="card-body">
                    <video id="preview"></video>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        console.log(content);
        // Handle the scanned QR code content here
        alert('Scanned: ' + content);
    });
    Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('No cameras found.');
        alert('No cameras found. Please make sure you have a camera connected.');
    }
}).catch(function (e) {
    console.error('Error accessing cameras:', e);
    alert('Error accessing cameras. Please check your camera settings and try again.');
});
</script>
@endsection
1