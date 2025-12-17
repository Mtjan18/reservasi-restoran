<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - The Family Table</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|poppins:300,400,500,600&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

        .hero-gallery {
            background-image: 
                linear-gradient(rgba(139, 0, 0, 0.7), rgba(139, 0, 0, 0.7)),
                url('https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&w=1920');
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

        .gallery-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s ease;
        }

        .gallery-item:hover {
            transform: scale(1.02);
        }

        .gallery-item img {
            transition: transform 0.6s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(139, 0, 0, 0.9), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .hero-gallery, .main-background {
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
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-[#8B0000] transition duration-300 font-medium">About</a>
                <a href="{{ route('gallery') }}" class="text-[#8B0000] font-semibold border-b-2 border-[#8B0000]">Gallery</a>
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#8B0000] transition duration-300 font-medium">← Home</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-gallery min-h-[60vh] flex items-center justify-center">
        <div class="text-center px-4 sm:px-6">
            <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold text-white mb-6 drop-shadow-2xl">Our Gallery</h1>
            <p class="text-xl sm:text-2xl text-white/95 max-w-3xl mx-auto drop-shadow-lg">
                Explore the moments, flavors, and atmosphere that make us special
            </p>
            <div class="w-32 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mt-6"></div>
        </div>
    </section>

    <!-- Gallery Categories -->
    <section class="main-background py-20">
        <div class="container mx-auto px-4 sm:px-6">
            
            <!-- Restaurant Interior -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Our Restaurant</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mb-4"></div>
                    <p class="text-gray-700 text-lg">Warm, inviting spaces designed for family gatherings</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/262047/pexels-photo-262047.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Restaurant Interior" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Main Dining Room</h3>
                                <p class="text-sm text-white/80">Spacious and comfortable seating</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/67468/pexels-photo-67468.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Cozy corner" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Intimate Corner</h3>
                                <p class="text-sm text-white/80">Perfect for romantic dinners</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/696218/pexels-photo-696218.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Bar area" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Bar & Lounge</h3>
                                <p class="text-sm text-white/80">Relax with craft cocktails</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Dishes -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Culinary Creations</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mb-4"></div>
                    <p class="text-gray-700 text-lg">Delicious dishes crafted with love and passion</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-72" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/1279330/pexels-photo-1279330.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Pasta dish" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-lg font-bold mb-1">Homemade Pasta</h3>
                                <p class="text-xs text-white/80">Fresh ingredients daily</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-72" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/1639562/pexels-photo-1639562.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Steak" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-lg font-bold mb-1">Premium Steak</h3>
                                <p class="text-xs text-white/80">Perfectly grilled</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-72" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Salad" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-lg font-bold mb-1">Fresh Garden Salad</h3>
                                <p class="text-xs text-white/80">Organic vegetables</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-72" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/291528/pexels-photo-291528.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Dessert" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-lg font-bold mb-1">Signature Dessert</h3>
                                <p class="text-xs text-white/80">Sweet perfection</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-72" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/1099680/pexels-photo-1099680.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Seafood" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-lg font-bold mb-1">Fresh Seafood</h3>
                                <p class="text-xs text-white/80">Ocean to table</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-72" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/1633578/pexels-photo-1633578.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Pizza" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-lg font-bold mb-1">Wood-Fired Pizza</h3>
                                <p class="text-xs text-white/80">Artisan style</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-72" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/70497/pexels-photo-70497.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Burger" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-lg font-bold mb-1">Gourmet Burger</h3>
                                <p class="text-xs text-white/80">Family favorite</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-72" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/1410235/pexels-photo-1410235.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Breakfast" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-lg font-bold mb-1">Sunday Brunch</h3>
                                <p class="text-xs text-white/80">Start your day right</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Happy Moments -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-4">Happy Moments</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mb-4"></div>
                    <p class="text-gray-700 text-lg">Celebrating life's special moments together</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3201921/pexels-photo-3201921.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Family dining" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Family Gathering</h3>
                                <p class="text-sm text-white/80">Creating memories</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3184183/pexels-photo-3184183.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Celebration" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Special Celebration</h3>
                                <p class="text-sm text-white/80">Birthdays & anniversaries</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3184192/pexels-photo-3184192.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Friends dinner" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Friends Night Out</h3>
                                <p class="text-sm text-white/80">Great food, great company</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3184195/pexels-photo-3184195.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Couple dining" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Date Night</h3>
                                <p class="text-sm text-white/80">Romantic atmosphere</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3184170/pexels-photo-3184170.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Kids dining" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Kids Love It!</h3>
                                <p class="text-sm text-white/80">Family-friendly environment</p>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item rounded-2xl overflow-hidden shadow-xl h-80" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3201763/pexels-photo-3201763.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Group celebration" 
                             class="w-full h-full object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">Group Events</h3>
                                <p class="text-sm text-white/80">Perfect for parties</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-br from-[#8B0000] to-[#B22222] text-white">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold mb-6">Ready to Create Your Own Memories?</h2>
            <p class="text-xl mb-10 text-white/90 max-w-2xl mx-auto">
                Reserve your table today and experience the warmth of The Family Table.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('reservation.create') }}" 
                   class="bg-white text-[#8B0000] font-bold py-4 px-10 rounded-full text-lg hover:bg-gray-100 transition duration-300 shadow-xl">
                    Make a Reservation
                </a>
                <a href="{{ route('about') }}" 
                   class="bg-transparent border-2 border-white text-white font-bold py-4 px-10 rounded-full text-lg hover:bg-white/10 transition duration-300">
                    Learn Our Story
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
                        <li><a href="{{ route('about') }}" class="text-white/80 hover:text-white transition">About</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-white hover:underline">Gallery</a></li>
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

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <img id="lightbox-img" src="" alt="Full size image">
        <button onclick="closeLightbox()" class="absolute top-8 right-8 text-white text-4xl font-bold hover:text-gray-300 transition">&times;</button>
    </div>

    <script>
        function openLightbox(element) {
            const img = element.querySelector('img');
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            
            lightboxImg.src = img.src.replace('w=800', 'w=1920'); // Get higher resolution
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close lightbox with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
</body>
</html>
