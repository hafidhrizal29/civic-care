<x-layouts.landing>
    <x-navbar />

    <x-hero />

    <x-categories-section :categories="$categories" />

    <x-features-section />

    <x-workflow-section />

    <x-statistics-section
        :totalComplaints="$totalComplaints"
        :processedComplaints="$processedComplaints"
        :completedComplaints="$completedComplaints"
        :totalCategories="$totalCategories"
    />

    <x-testimonials-section />

    <x-faq-section />

    <x-cta-section />

    <x-footer />
</x-layouts.landing>
