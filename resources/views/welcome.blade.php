<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warm Family Dining - Restaurant Reservation</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|poppins:300,400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)),
                              url('https://images.pexels.com/photos/3201921/pexels-photo-3201921.jpeg?auto=compress&cs=tinysrgb&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-in;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-12px);
        }

        .image-card {
            overflow: hidden;
            position: relative;
        }

        .image-card img {
            transition: transform 0.6s ease;
        }

        .image-card:hover img {
            transform: scale(1.1);
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(139, 0, 0, 0.8), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .image-card:hover .image-overlay {
            opacity: 1;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8B0000 0%, #B22222 100%);
            box-shadow: 0 10px 30px rgba(139, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            box-shadow: 0 15px 40px rgba(139, 0, 0, 0.4);
            transform: translateY(-2px);
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .decorative-line {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .hero-section {
                background-attachment: scroll;
            }
        }
    </style>
</head>
<body class="bg-[#FAF0E6]">

    <header class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50 transition-all duration-300">
        <nav class="container mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <span class="text-4xl group-hover:scale-110 transition-transform duration-300">🍽️</span>
                <span class="text-2xl sm:text-3xl font-bold text-[#8B0000] tracking-wide">The Family Table</span>
            </a>
            <div class="flex items-center space-x-6">
                <a href="{{ route('about') }}" class="hidden md:inline-block text-gray-700 hover:text-[#8B0000] transition duration-300 font-medium">About</a>
                <a href="{{ route('gallery') }}" class="hidden md:inline-block text-gray-700 hover:text-[#8B0000] transition duration-300 font-medium">Gallery</a>
                <a href="/login" class="text-gray-600 hover:text-[#8B0000] transition duration-300 font-semibold border-2 border-[#8B0000] px-4 py-2 rounded-full hover:bg-[#8B0000] hover:text-white">Admin</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section min-h-screen flex items-center justify-center relative">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#FAF0E6]/20"></div>
            <div class="text-center z-10 px-4 sm:px-6 md:px-10 max-w-5xl animate-fade-in">
                <div class="mb-6">
                    <span class="inline-block bg-white/20 backdrop-blur-md text-white px-6 py-2 rounded-full text-sm font-medium border border-white/30">
                        Established 2010
                    </span>
                </div>
                <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold mb-6 leading-tight text-white tracking-tight drop-shadow-2xl">
                    Where Every Meal<br/>Feels Like Home
                </h1>
                <p class="text-xl sm:text-2xl mb-12 font-light text-white/95 drop-shadow-lg max-w-3xl mx-auto">
                    Experience the warmth of family dining with exceptional cuisine, cozy ambiance, and unforgettable moments together.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('reservation.create') }}"
                       class="btn-primary text-white font-semibold py-4 px-10 rounded-full text-lg border-2 border-[#FFD700] inline-flex items-center space-x-2 group">
                        <span>Reserve Your Table</span>
                        <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </a>

                    <a href="{{ route('booking.check.form') }}"
                       class="bg-white/95 backdrop-blur-sm hover:bg-white text-[#8B0000] font-semibold py-4 px-10 rounded-full shadow-xl transition duration-300 transform hover:scale-105 text-lg border-2 border-white">
                        Check Booking
                    </a>
                </div>

                <div class="mt-16 grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-2">15+</div>
                        <div class="text-white/80 text-sm sm:text-base">Years Serving</div>
                    </div>
                    <div class="text-center border-x border-white/30">
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-2">50K+</div>
                        <div class="text-white/80 text-sm sm:text-base">Happy Guests</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-2">4.9★</div>
                        <div class="text-white/80 text-sm sm:text-base">Rating</div>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </section>

        <section id="about" class="py-20 bg-white">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="text-center mb-16 animate-slide-up">
                    <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Our Story</h2>
                    <div class="decorative-line mb-6"></div>
                    <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                        For over 15 years, The Family Table has been a cornerstone of our community, serving home-style meals that bring families together. Our passion is creating a welcoming space where memories are made over delicious food.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="order-2 md:order-1">
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-[#8B0000] rounded-full flex items-center justify-center text-white text-xl">
                                    🏠
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Home-Style Cooking</h3>
                                    <p class="text-gray-600">Traditional recipes passed down through generations, made with love and the finest ingredients.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-[#8B0000] rounded-full flex items-center justify-center text-white text-xl">
                                    ❤️
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Family Atmosphere</h3>
                                    <p class="text-gray-600">A cozy, welcoming environment where everyone feels like part of our extended family.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-[#8B0000] rounded-full flex items-center justify-center text-white text-xl">
                                    🌟
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Exceptional Service</h3>
                                    <p class="text-gray-600">Our dedicated team ensures every visit is memorable with personalized attention and care.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 md:order-2">
                        <div class="image-card rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://images.pexels.com/photos/3184183/pexels-photo-3184183.jpeg?auto=compress&cs=tinysrgb&w=800"
                                 alt="Family dining together"
                                 class="w-full h-[400px] object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gradient-to-b from-[#FAF0E6] to-white">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Why Choose Us</h2>
                    <div class="decorative-line mb-6"></div>
                    <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                        Our seamless reservation system ensures your dining experience starts perfectly from the moment you book.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="feature-card p-8 bg-white rounded-3xl shadow-lg hover:shadow-2xl border-b-4 border-[#FFD700]">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#8B0000] to-[#B22222] rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg">
                            ⏱️
                        </div>
                        <h3 class="text-2xl font-semibold mb-4 text-gray-800">Real-Time Availability</h3>
                        <p class="text-gray-600 leading-relaxed">Monitor table status instantly and secure your preferred spot without any double booking concerns. Our live system updates every second.</p>
                    </div>

                    <div class="feature-card p-8 bg-white rounded-3xl shadow-lg hover:shadow-2xl border-b-4 border-[#FFD700]">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#8B0000] to-[#B22222] rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg">
                            ✅
                        </div>
                        <h3 class="text-2xl font-semibold mb-4 text-gray-800">Instant Confirmation</h3>
                        <p class="text-gray-600 leading-relaxed">Receive your unique booking code immediately upon reservation. Quick check-in process gets you to your table faster.</p>
                    </div>

                    <div class="feature-card p-8 bg-white rounded-3xl shadow-lg hover:shadow-2xl border-b-4 border-[#FFD700]">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#8B0000] to-[#B22222] rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg">
                            🔔
                        </div>
                        <h3 class="text-2xl font-semibold mb-4 text-gray-800">Smart Reminders</h3>
                        <p class="text-gray-600 leading-relaxed">Get automatic notifications via email or SMS about your reservation. Never miss your special dining date with us.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="gallery" class="py-20 bg-white">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Experience Our Warmth</h2>
                    <div class="decorative-line mb-6"></div>
                    <p class="text-gray-600 text-lg">A glimpse into our cozy atmosphere and delicious offerings</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                    <div class="image-card rounded-2xl overflow-hidden shadow-xl h-80 relative">
                        <img src="https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&w=600"
                             alt="Cozy interior"
                             class="w-full h-full object-cover">
                        <div class="image-overlay flex items-end p-6">
                            <p class="text-white font-semibold text-lg">Cozy Interior</p>
                        </div>
                    </div>

                    <div class="image-card rounded-2xl overflow-hidden shadow-xl h-80 relative">
                        <img src="https://images.pexels.com/photos/1410235/pexels-photo-1410235.jpeg?auto=compress&cs=tinysrgb&w=600"
                             alt="Delicious meals"
                             class="w-full h-full object-cover">
                        <div class="image-overlay flex items-end p-6">
                            <p class="text-white font-semibold text-lg">Delicious Cuisine</p>
                        </div>
                    </div>

                    <div class="image-card rounded-2xl overflow-hidden shadow-xl h-80 relative">
                        <img src="https://images.pexels.com/photos/3201921/pexels-photo-3201921.jpeg?auto=compress&cs=tinysrgb&w=600"
                             alt="Family gathering"
                             class="w-full h-full object-cover">
                        <div class="image-overlay flex items-end p-6">
                            <p class="text-white font-semibold text-lg">Family Gatherings</p>
                        </div>
                    </div>

                    <div class="image-card rounded-2xl overflow-hidden shadow-xl h-80 relative">
                        <img src="https://images.pexels.com/photos/3184192/pexels-photo-3184192.jpeg?auto=compress&cs=tinysrgb&w=600"
                             alt="Special occasions"
                             class="w-full h-full object-cover">
                        <div class="image-overlay flex items-end p-6">
                            <p class="text-white font-semibold text-lg">Special Occasions</p>
                        </div>
                    </div>

                    <div class="image-card rounded-2xl overflow-hidden shadow-xl h-80 relative">
                        <img src="https://images.pexels.com/photos/1126728/pexels-photo-1126728.jpeg?auto=compress&cs=tinysrgb&w=600"
                             alt="Signature dishes"
                             class="w-full h-full object-cover">
                        <div class="image-overlay flex items-end p-6">
                            <p class="text-white font-semibold text-lg">Signature Dishes</p>
                        </div>
                    </div>

                    <div class="image-card rounded-2xl overflow-hidden shadow-xl h-80 relative">
                        <img src="https://images.pexels.com/photos/1395967/pexels-photo-1395967.jpeg?auto=compress&cs=tinysrgb&w=600"
                             alt="Warm ambiance"
                             class="w-full h-full object-cover">
                        <div class="image-overlay flex items-end p-6">
                            <p class="text-white font-semibold text-lg">Warm Ambiance</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gradient-to-br from-[#FAF0E6] to-[#FFF8DC]">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">What Our Guests Say</h2>
                    <div class="decorative-line mb-6"></div>
                    <p class="text-gray-600 text-lg">Real experiences from our cherished guests</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="testimonial-card">
                        <div class="flex items-center mb-4">
                            <div class="text-3xl mr-3">👨‍👩‍👧‍👦</div>
                            <div>
                                <h4 class="font-semibold text-gray-800">The Johnson Family</h4>
                                <div class="text-[#FFD700]">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic leading-relaxed">
                            "This place truly feels like a second home. The food is incredible, and the staff treats us like family. Our kids love coming here!"
                        </p>
                    </div>

                    <div class="testimonial-card">
                        <div class="flex items-center mb-4">
                            <div class="text-3xl mr-3">👫</div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Sarah & Michael</h4>
                                <div class="text-[#FFD700]">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic leading-relaxed">
                            "Perfect for date nights! The cozy atmosphere and exceptional service make every visit special. The reservation system is so convenient."
                        </p>
                    </div>

                    <div class="testimonial-card">
                        <div class="flex items-center mb-4">
                            <div class="text-3xl mr-3">👵</div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Margaret Wilson</h4>
                                <div class="text-[#FFD700]">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic leading-relaxed">
                            "I've been coming here for years. The consistency in quality and warmth is remarkable. It reminds me of Sunday dinners at my grandmother's."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gradient-to-br from-[#8B0000] to-[#B22222] text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            </div>
            <div class="container mx-auto px-4 sm:px-6 text-center relative z-10">
                <h2 class="text-4xl sm:text-5xl font-bold mb-6">Ready to Join Our Family?</h2>
                <p class="text-xl mb-10 text-white/90 max-w-2xl mx-auto">
                    Reserve your table now and experience the warmth, comfort, and exceptional dining that our guests rave about.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('reservation.create') }}"
                       class="bg-white text-[#8B0000] font-bold py-4 px-10 rounded-full shadow-2xl transition duration-300 transform hover:scale-105 text-lg hover:shadow-white/20 inline-flex items-center space-x-2 group">
                        <span>Book Your Table Now</span>
                        <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </a>
                    <a href="{{ route('booking.check.form') }}"
                       class="bg-transparent border-2 border-white text-white font-bold py-4 px-10 rounded-full transition duration-300 transform hover:scale-105 text-lg hover:bg-white/10">
                        View My Reservation
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-[#700000] text-white py-12">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4 flex items-center space-x-2">
                        <span>🍽️</span>
                        <span>The Family Table</span>
                    </h3>
                    <p class="text-white/80 leading-relaxed">
                        Creating memorable dining experiences for families since 2010. Where every meal feels like home.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-white/80">
                        <li><a href="#about" class="hover:text-[#FFD700] transition">About Us</a></li>
                        <li><a href="#gallery" class="hover:text-[#FFD700] transition">Gallery</a></li>
                        <li><a href="{{ route('reservation.create') }}" class="hover:text-[#FFD700] transition">Make Reservation</a></li>
                        <li><a href="{{ route('booking.check.form') }}" class="hover:text-[#FFD700] transition">Check Booking</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-white/80">
                        <li>📍 123 Family Street, Your City</li>
                        <li>📞 (555) 123-4567</li>
                        <li>✉️ info@familytable.com</li>
                        <li>🕒 Mon-Sun: 11am - 10pm</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/20 pt-8 text-center text-white/70 text-sm">
                <p>&copy; 2025 The Family Table Digital Reservation System. All Rights Reserved. Made with ❤️ for our community.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.feature-card, .testimonial-card, .image-card').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
    </script>
</body>
</html>