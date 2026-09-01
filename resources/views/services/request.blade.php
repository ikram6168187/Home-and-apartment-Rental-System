<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Request Service - Smart Rent</title>


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">


    @include('Modal style')


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f5f5f5;
            color: #333;
        }


        /* Main Container */

        .request-container {
            width: 92%;
            max-width: 850px;
            margin: 55px auto 70px;
        }


        /* Header */

        .request-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .request-header .small-title {
            color: #8b5e3c;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .request-header h1 {
            font-size: 34px;
            color: #332f2e;
            margin-bottom: 12px;
        }

        .request-header p {
            color: #777;
            font-size: 15px;
        }


        /* Form Card */

        .request-card {
            background: white;
            border-radius: 18px;
            padding: 35px;

            box-shadow: 0 10px 30px rgba(0,0,0,0.08);

            border: 1px solid #eee;
        }


        /* Selected Service */

        .selected-service {
            display: flex;
            align-items: center;
            gap: 15px;

            padding: 18px;
            margin-bottom: 30px;

            background: #f7ede4;
            border-radius: 12px;

            border-left: 4px solid #8b5e3c;
        }

        .selected-service i {
            font-size: 24px;
            color: #8b5e3c;
        }

        .selected-service h3 {
            color: #332f2e;
            margin-bottom: 4px;
        }

        .selected-service p {
            font-size: 13px;
            color: #777;
        }


        /* Form */

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;

            font-size: 14px;
            font-weight: 600;

            color: #444;
        }

        .form-group label span {
            color: #dc3545;
        }

        .form-control {
            width: 100%;
            padding: 13px 15px;

            border: 1px solid #ddd;
            border-radius: 8px;

            font-size: 14px;

            outline: none;

            transition: 0.3s ease;
        }

        .form-control:focus {
            border-color: #8b5e3c;

            box-shadow: 0 0 0 3px rgba(139,94,60,0.10);
        }

        textarea.form-control {
            min-height: 140px;
            resize: vertical;
        }


        /* Form Grid */

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }


        /* Button */

        .submit-btn {
            width: 100%;
            border: none;

            background: #332f2e;
            color: white;

            padding: 14px;

            border-radius: 8px;

            font-size: 15px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.3s ease;
        }

        .submit-btn:hover {
            background: #8b5e3c;
            transform: translateY(-2px);
        }


        /* Back Button */

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-top: 20px;

            color: #555;
            font-size: 14px;
        }

        .back-link:hover {
            color: #8b5e3c;
        }


        /* Errors */

        .error-message {
            display: block;
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
        }


        /* Responsive */

        @media(max-width: 600px) {

            .request-card {
                padding: 25px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .request-header h1 {
                font-size: 28px;
            }

        }

    </style>

</head>


<body>


{{-- NAVBAR --}}
@include('navbar')


{{-- MODALS --}}
@include('login modal')
@include('signup modal')
@include('logout modal')


<div class="request-container">


    <!-- Header -->

    <div class="request-header">

        <div class="small-title">
            Smart Rent Services
        </div>

        <h1>Request a Service</h1>

        <p>
            Fill in the details below and submit your service request.
        </p>

    </div>



    <!-- Form Card -->

    <div class="request-card">


        <!-- Selected Service -->

        <div class="selected-service">

            <i class="fa-solid fa-handshake"></i>

            <div>

                <h3 id="selectedServiceName">
                    Service Request
                </h3>

                <p>
                    You are requesting a Smart Rent service.
                </p>

            </div>

        </div>


        <form action="{{ route('services.store') }}"
              method="POST">

            @csrf


            <!-- Service Type -->

            <input type="hidden"
                   name="service_type"
                   value="{{ $serviceType }}">


            <!-- Property + Date -->

            <div class="form-row">


                <div class="form-group">

                    <label>
                        Related Property
                    </label>

                    <select name="property_id"
                            class="form-control">

                        <option value="">
                            Select Property (Optional)
                        </option>

                        @foreach($properties as $property)

                            <option value="{{ $property->id }}">

                                {{ $property->title ?? 'Property #' . $property->id }}

                            </option>

                        @endforeach

                    </select>

                    @error('property_id')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>



                <div class="form-group">

                    <label>
                        Preferred Date
                    </label>

                    <input type="date"
                           name="preferred_date"
                           min="{{ date('Y-m-d') }}"
                           class="form-control"
                           value="{{ old('preferred_date') }}">

                    @error('preferred_date')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

            </div>



            <!-- Request Details -->

            <div class="form-group">

                <label>
                    Request Details <span>*</span>
                </label>

                <textarea
                    name="request_details"
                    class="form-control"
                    placeholder="Please describe your requirements in detail...">{{ old('request_details') }}</textarea>

                @error('request_details')

                    <span class="error-message">
                        {{ $message }}
                    </span>

                @enderror

            </div>



            <!-- Submit -->

            <button type="submit"
                    class="submit-btn">

                <i class="fa-solid fa-paper-plane"></i>

                Submit Service Request

            </button>


        </form>


        <a href="{{ route('services.index') }}"
           class="back-link">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Services

        </a>


    </div>


</div>


<script>

    const serviceNames = {

        home_maintenance: 'Home Maintenance',

        property_inspection: 'Property Inspection',

        digital_rental_agreement: 'Digital Rental Agreement',

        moving_relocation: 'Moving & Relocation',

        photography_virtual_tour: 'Photography & Virtual Tour'

    };


    const selectedService = "{{ $serviceType }}";


    if (serviceNames[selectedService]) {

        document.getElementById('selectedServiceName').innerText =
            serviceNames[selectedService];

    }

</script>


{{-- MODAL SCRIPTS --}}
@include('Modal scripts')


</body>

</html>