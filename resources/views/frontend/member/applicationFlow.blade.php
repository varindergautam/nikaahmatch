
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom style for the pink and white button */
        .pink-button-container {
            text-align: center; /* Center align the buttons */
            margin-top: 20px; /* Add margin to the top */
        }

        .pink-button {
            position: relative; /* Position relative for arrow positioning */
            background-color: #ff69b4; /* Pink color */
            color: #ffffff; /* White color for text */
            border: 1px solid #ff69b4; /* Pink border */
            transition: background-color 0.3s ease;
            padding: 15px 60px; /* Adjust padding as needed */
            border-radius: 10px; /* Add border radius for rounded corners */
            cursor: pointer; /* Change cursor on hover */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Add text shadow for depth */
            margin: 0 10px; /* Add margin between buttons */
            margin-bottom: 25px;
        }

        .pink-button:hover {
            background-color: #e85aad; /* Lighter pink on hover */
            border-color: #e85aad;
        }

        .arrow {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 10px 15px 0; /* Adjusted border-width for better visibility */
            border-color: #ff69b4 transparent transparent;
            margin-top: 5px; /* Adjusted margin for better positioning */
        }

        .font-weight-bold {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Media query for mobile view */
        @media (max-width: 767px) {
            .pink-button {
                margin-bottom: 20px; /* Add space between buttons in mobile view */
            }
        }
    </style>


<div class="container pink-button-container">
<a href="{{ route('profile_settings') }}" class="btn pink-button">
        <div>
            <div class="font-weight-bold">Update profile</div>
        </div>
        <div class="arrow"></div>
    </a>
    <a href="{{ route('profile_settings') }}" class="btn pink-button">
        <div>
            <div class="font-weight-bold">Admin approval</div>
        </div>
        <div class="arrow"></div>
    </a>
    <a href="{{ route('member.listing') }}" class="btn pink-button">
        <div>
            <div class="font-weight-bold">Search Match</div>
        </div>
        <div class="arrow"></div>
    </a>
    <a href="{{ route('interest_requests') }}" class="btn pink-button">
        <div>
            <div class="font-weight-bold">Express Interest</div>
        </div>
        <div class="arrow"></div>
    </a>
    <a href="{{ route('my_shortlists') }}" class="btn pink-button">
        <div>
            <div class="font-weight-bold">Shortlist Profile</div>
        </div>
        <div class="arrow"></div>
    </a>
    <a href="{{ route('my_interests.index') }}" class="btn pink-button">
        <div>
            <div class="font-weight-bold">Interest Request</div>
        </div>
        <div class="arrow"></div>
    </a>
    <a href="{{ route('all.messages') }}" class="btn pink-button">
        <div>
            <div class="font-weight-bold">Messaging</div>
        </div>
        <div class="arrow"></div>
    </a>
    <!-- Repeat the above block for the remaining buttons -->

    <a href="{{ route('happy-story.create') }}" class="btn pink-button">
        <div>
            <div class="font-weight-bold">Happy Story</div>
        </div>
    </a>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
