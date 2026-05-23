@extends('customer.layouts.app')

@section('title', 'About | 404.Coffee')

@push('styles')

<link rel="stylesheet"
      href="{{ asset('css/customer/about.css') }}">

@endpush

@section('content')

<!-- HERO -->
<section class="about-hero">

    <div class="about-hero-content">

        <h1>
            Brewed Beyond Coffee.
        </h1>

        <p>
            404.Coffee is more than just a coffee shop. We combine modern cafe vibes,
            technology, and handcrafted flavors into one experience built for creators,
            workers, gamers, students, and coffee lovers.
        </p>

    </div>

</section>

<!-- ABOUT -->
<section class="about-section">

    <div class="section-title">

        <h2>
            Why 404.Coffee?
        </h2>

        <p>
            Designed with passion, technology, and coffee culture.
        </p>

    </div>

    <div class="about-grid">

        <div class="about-card">

            <i class="fa-solid fa-mug-hot"></i>

            <h3>
                Premium Coffee
            </h3>

            <p>
                Carefully selected beans and handcrafted brewing methods create rich,
                smooth, and memorable flavors in every cup.
            </p>

        </div>

        <div class="about-card">

            <i class="fa-solid fa-laptop-code"></i>

            <h3>
                Modern Experience
            </h3>

            <p>
                Built with digital ordering systems, live kitchen tracking,
                and seamless customer experiences powered by technology.
            </p>

        </div>

        <div class="about-card">

            <i class="fa-solid fa-users"></i>

            <h3>
                Community Space
            </h3>

            <p>
                A place where people gather, work, relax, create ideas,
                and enjoy meaningful conversations.
            </p>

        </div>

    </div>

</section>

<!-- TEAM -->
<section class="team-section">

    <div class="section-title">

        <h2>
            Meet Our Team
        </h2>

        <p>
            The people behind the coffee and experience.
        </p>

    </div>

    <div class="team-grid">

        <div class="team-card">

            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1200&auto=format&fit=crop"
                 alt="Team">

            <div class="team-card-content">

                <h3>
                    Lail Alvi
                </h3>

                <span>
                    Founder & Developer
                </span>

            </div>

        </div>

        <div class="team-card">

            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1200&auto=format&fit=crop"
                 alt="Team">

            <div class="team-card-content">

                <h3>
                    Nazala
                </h3>

                <span>
                    Cashier & Customer Service
                </span>

            </div>

        </div>

        <div class="team-card">

            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=1200&auto=format&fit=crop"
                 alt="Team">

            <div class="team-card-content">

                <h3>
                    Wahyu
                </h3>

                <span>
                    Kitchen Specialist
                </span>

            </div>

        </div>

    </div>

</section>

<!-- STATS -->
<section class="stats-section">

    <div class="stats-grid">

        <div class="stats-card">

            <h2>
                50+
            </h2>

            <p>
                Menu Variants
            </p>

        </div>

        <div class="stats-card">

            <h2>
                1000+
            </h2>

            <p>
                Happy Customers
            </p>

        </div>

        <div class="stats-card">

            <h2>
                24/7
            </h2>

            <p>
                System Monitoring
            </p>

        </div>

        <div class="stats-card">

            <h2>
                404
            </h2>

            <p>
                Coffee Vibes
            </p>

        </div>

    </div>

</section>

<!-- CTA -->
<section class="cta-section">

    <h2>
        Ready To Experience 404.Coffee?
    </h2>

    <p>
        Explore our menu, order your favorite drinks,
        and enjoy a modern coffee experience designed for everyone.
    </p>

    <a href="{{ route('customer.menu') }}"
       class="cta-btn">

        <i class="fa-solid fa-mug-hot"></i>

        Explore Menu

    </a>

</section>

@endsection