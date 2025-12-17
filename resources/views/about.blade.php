<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - The Family Table</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|poppins:300,400,500,600&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

        .hero-about {
            background-image: 
                linear-gradient(rgba(139, 0, 0, 0.7), rgba(139, 0, 0, 0.7)),
                url('https://images.pexels.com/photos/3201921/pexels-photo-3201921.jpeg?auto=compress&cs=tinysrgb&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .main-background {
            position: relative;
            background-image: 
                linear-gradient(135deg, rgba(250, 240, 230, 0.5) 0%, rgba(255, 248, 220, 0.5) 100%),
                url('https://images.pexels.com/photos/3184183/pexels-photo-3184183.jpeg?auto=compress&cs=tinysrgb&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .card-with-bg {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .team-card {
            transition: all 0.4s ease;
        }
        .team-card:hover {
            transform: translateY(-10px);
        }

        .value-card {
            transition: all 0.3s ease;
        }
        .value-card:hover {
            transform: scale(1.05);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 100%;
            background: linear-gradient(to bottom, #8B0000, #FFD700);
        }

        @media (max-width: 768px) {
            .hero-about, .main-background {
                background-attachment: scroll;
            }
        }
    </style>
</head>
<body class="bg-[#FAF0E6]">

    <!-- Header -->
    <header class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <span class="text-4xl group-hover:scale-110 transition-transform duration-300">🍽️</span>
                <span class="text-2xl sm:text-3xl font-bold text-[#8B0000] tracking-wide">The Family Table</span>
            </a>
            <div class="flex items-center space-x-6">
                <a href="{{ route('about') }}" class="text-[#8B0000] font-semibold border-b-2 border-[#8B0000]">About</a>
                <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-[#8B0000] transition duration-300 font-medium">Gallery</a>
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#8B0000] transition duration-300 font-medium">← Home</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-about min-h-[60vh] flex items-center justify-center">
        <div class="text-center px-4 sm:px-6">
            <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold text-white mb-6 drop-shadow-2xl">About Us</h1>
            <p class="text-xl sm:text-2xl text-white/95 max-w-3xl mx-auto drop-shadow-lg">
                Where family traditions meet culinary excellence
            </p>
            <div class="w-32 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mt-6"></div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-6">Our Story</h2>
                        <div class="w-20 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mb-6"></div>
                        <p class="text-gray-700 text-lg leading-relaxed mb-4">
                            The Family Table was born from a simple dream: to create a place where families could gather, share meals, and create lasting memories. Founded in 2015, our restaurant has become a beloved cornerstone of the community.
                        </p>
                        <p class="text-gray-700 text-lg leading-relaxed mb-4">
                            What started as a small family-owned establishment has grown into a destination for those seeking authentic, home-cooked meals in a warm, welcoming atmosphere. Every dish we serve is crafted with love, using recipes passed down through generations.
                        </p>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            Today, we continue to honor our roots while embracing innovation, ensuring that every guest feels like part of our extended family.
                        </p>
                    </div>
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.pexels.com/photos/3184183/pexels-photo-3184183.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Family dining" 
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="main-background py-20">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Our Core Values</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mb-6"></div>
                <p class="text-gray-700 text-lg max-w-3xl mx-auto">
                    The principles that guide everything we do
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-7xl mx-auto">
                <div class="value-card card-with-bg rounded-2xl p-6 shadow-xl text-center">
                    <div class="text-5xl mb-4">❤️</div>
                    <h3 class="text-xl font-bold text-[#8B0000] mb-3">Family First</h3>
                    <p class="text-gray-600 text-sm">
                        We treat every guest as part of our family, creating a warm and welcoming environment.
                    </p>
                </div>

                <div class="value-card card-with-bg rounded-2xl p-6 shadow-xl text-center">
                    <div class="text-5xl mb-4">🌟</div>
                    <h3 class="text-xl font-bold text-[#8B0000] mb-3">Quality</h3>
                    <p class="text-gray-600 text-sm">
                        We use only the finest, freshest ingredients to ensure every dish exceeds expectations.
                    </p>
                </div>

                <div class="value-card card-with-bg rounded-2xl p-6 shadow-xl text-center">
                    <div class="text-5xl mb-4">🤝</div>
                    <h3 class="text-xl font-bold text-[#8B0000] mb-3">Community</h3>
                    <p class="text-gray-600 text-sm">
                        We're proud to be part of our local community and support local suppliers.
                    </p>
                </div>

                <div class="value-card card-with-bg rounded-2xl p-6 shadow-xl text-center">
                    <div class="text-5xl mb-4">🎯</div>
                    <h3 class="text-xl font-bold text-[#8B0000] mb-3">Excellence</h3>
                    <p class="text-gray-600 text-sm">
                        We strive for perfection in every detail, from service to presentation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Meet Our Team</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mb-6"></div>
                <p class="text-gray-700 text-lg max-w-3xl mx-auto">
                    The talented people behind your memorable dining experience
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="team-card bg-white rounded-2xl overflow-hidden shadow-xl">
                    <div class="h-64 bg-gradient-to-br from-[#8B0000] to-[#B22222]">
                        <img src="https://images.pexels.com/photos/2474307/pexels-photo-2474307.jpeg?auto=compress&cs=tinysrgb&w=400" 
                             alt="Chef" 
                             class="w-full h-full object-cover opacity-90">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-2xl font-bold text-[#8B0000] mb-2">Chef Michael Rodriguez</h3>
                        <p class="text-gray-600 font-medium mb-3">Executive Chef</p>
                        <p class="text-gray-600 text-sm">
                            With 20+ years of culinary experience, Chef Michael brings passion and creativity to every dish.
                        </p>
                    </div>
                </div>

                <div class="team-card bg-white rounded-2xl overflow-hidden shadow-xl">
                    <div class="h-64 bg-gradient-to-br from-[#8B0000] to-[#B22222]">
                        <img src="https://images.pexels.com/photos/3756679/pexels-photo-3756679.jpeg?auto=compress&cs=tinysrgb&w=400" 
                             alt="Manager" 
                             class="w-full h-full object-cover opacity-90">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-2xl font-bold text-[#8B0000] mb-2">Sarah Thompson</h3>
                        <p class="text-gray-600 font-medium mb-3">Restaurant Manager</p>
                        <p class="text-gray-600 text-sm">
                            Sarah ensures every guest receives exceptional service and leaves with a smile.
                        </p>
                    </div>
                </div>

                <div class="team-card bg-white rounded-2xl overflow-hidden shadow-xl">
                    <div class="h-64 bg-gradient-to-br from-[#8B0000] to-[#B22222]">
                        <img src="https://images.pexels.com/photos/3814446/pexels-photo-3814446.jpeg?auto=compress&cs=tinysrgb&w=400" 
                             alt="Sommelier" 
                             class="w-full h-full object-cover opacity-90">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-2xl font-bold text-[#8B0000] mb-2">David Chen</h3>
                        <p class="text-gray-600 font-medium mb-3">Head Sommelier</p>
                        <p class="text-gray-600 text-sm">
                            David curates our wine selection and helps guests find the perfect pairing.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Journey Timeline -->
    <section class="main-background py-20">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Our Journey</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mb-6"></div>
                <p class="text-gray-700 text-lg max-w-3xl mx-auto">
                    Milestones that shaped The Family Table
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-8">
                <div class="card-with-bg rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#8B0000] to-[#B22222] flex items-center justify-center text-white font-bold text-xl">
                                2015
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#8B0000] mb-2">The Beginning</h3>
                            <p class="text-gray-700">
                                The Family Table opened its doors with just 10 tables and a dream to bring families together through food.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-with-bg rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#8B0000] to-[#B22222] flex items-center justify-center text-white font-bold text-xl">
                                2018
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#8B0000] mb-2">Expansion</h3>
                            <p class="text-gray-700">
                                Due to overwhelming support, we doubled our seating capacity and introduced our signature Sunday brunch.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-with-bg rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#8B0000] to-[#B22222] flex items-center justify-center text-white font-bold text-xl">
                                2021
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#8B0000] mb-2">Award Recognition</h3>
                            <p class="text-gray-700">
                                Honored with "Best Family Restaurant" award and featured in multiple culinary magazines.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-with-bg rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#8B0000] to-[#B22222] flex items-center justify-center text-white font-bold text-xl">
                                2025
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#8B0000] mb-2">Digital Innovation</h3>
                            <p class="text-gray-700">
                                Launched our online reservation system to better serve our growing family of guests.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-br from-[#8B0000] to-[#B22222] text-white">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold mb-6">Join Our Family Today</h2>
            <p class="text-xl mb-10 text-white/90 max-w-2xl mx-auto">
                Experience the warmth, flavor, and hospitality that have made us a beloved dining destination.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('reservation.create') }}" 
                   class="bg-white text-[#8B0000] font-bold py-4 px-10 rounded-full text-lg hover:bg-gray-100 transition duration-300 shadow-xl">
                    Reserve a Table
                </a>
                <a href="{{ route('gallery') }}" 
                   class="bg-transparent border-2 border-white text-white font-bold py-4 px-10 rounded-full text-lg hover:bg-white/10 transition duration-300">
                    View Gallery
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#700000] text-white py-12">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">The Family Table</h3>
                    <p class="text-white/80 text-sm">Creating memorable dining experiences for families since 2015.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-white/80 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-white hover:underline">About</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-white/80 hover:text-white transition">Gallery</a></li>
                        <li><a href="{{ route('reservation.create') }}" class="text-white/80 hover:text-white transition">Reserve</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <p class="text-white/80 text-sm mb-2">📞 (555) 123-4567</p>
                    <p class="text-white/80 text-sm mb-2">📧 info@familytable.com</p>
                    <p class="text-white/80 text-sm">🕐 Mon-Sun: 11am - 10pm</p>
                </div>
            </div>
            <div class="border-t border-white/20 pt-8 text-center text-white/70 text-sm">
                <p>&copy; 2025 The Family Table. Made with ❤️ for memorable family moments.</p>
            </div>
        </div>
    </footer>
</body>
</html>
