@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Privacy Policy</h1>
    
    <div class="prose max-w-none">
        <p class="mb-4">Last updated: {{ date('F j, Y') }}</p>

        <h2 class="text-xl font-semibold mt-6 mb-4">1. Information We Collect</h2>
        <p class="mb-4">Today Rates is committed to protecting your privacy. We do not collect any personal information from our users unless explicitly provided.</p>

        <h2 class="text-xl font-semibold mt-6 mb-4">2. Usage Data</h2>
        <p class="mb-4">We may collect anonymous usage data about how our website is accessed and used. This may include:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>Browser type and version</li>
            <li>Operating system</li>
            <li>Pages visited</li>
            <li>Time and date of visits</li>
            <li>Time spent on pages</li>
        </ul>

        <h2 class="text-xl font-semibold mt-6 mb-4">3. Cookies</h2>
        <p class="mb-4">We use cookies to enhance your experience on our website. These are small files stored on your device that help us provide certain features and functionality.</p>

        <h2 class="text-xl font-semibold mt-6 mb-4">4. How We Use Your Information</h2>
        <p class="mb-4">Any information we collect is used to:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>Improve our website functionality</li>
            <li>Analyze usage patterns</li>
            <li>Enhance user experience</li>
        </ul>

        <h2 class="text-xl font-semibold mt-6 mb-4">5. Data Security</h2>
        <p class="mb-4">We implement appropriate security measures to protect any information we collect. However, no method of transmission over the internet is 100% secure.</p>

        <h2 class="text-xl font-semibold mt-6 mb-4">6. Third-Party Services</h2>
        <p class="mb-4">We may use third-party services to monitor and analyze the use of our website. These services may have access to collected information as required to perform their functions.</p>

        <h2 class="text-xl font-semibold mt-6 mb-4">7. Changes to This Policy</h2>
        <p class="mb-4">We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>

        <h2 class="text-xl font-semibold mt-6 mb-4">8. Contact Us</h2>
        <p class="mb-4">If you have any questions about this Privacy Policy, please contact us.</p>
    </div>
</div>
@endsection 