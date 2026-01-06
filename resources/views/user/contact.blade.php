@extends("user.layouts.master-layouts.plain")

<title>Grocery Station One | Contact </title>

@push("script")
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@push("style")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">

@endpush

@section("content")
<div class="bg-gray-50 mt-16">
    <!-- Animated Background Elements -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="floating-element absolute top-1/4 left-10 w-20 h-20 bg-[var(--primary-color)] rounded-full opacity-10"></div>
        <div class="floating-element absolute top-2/3 right-20 w-16 h-16 bg-[var(--secondary-color)] rounded-full opacity-10" style="animation-delay: 2s;"></div>
        <div class="floating-element absolute top-1/3 right-1/4 w-12 h-12 bg-[var(--accent-color)] rounded-full opacity-10" style="animation-delay: 4s;"></div>
    </div>

    <!-- Page Header -->
    <section class="relative bg-gradient-to-r from-[var(--primary-color)] to-[var(--secondary-color)] py-16 overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-4 animate-fade-in-down">Get In Touch</h1>
                <p class="text-xl max-w-2xl mx-auto mb-8">We're here to help with any questions about our products, delivery, or your shopping experience.</p>
                
                <!-- Progress Steps -->
                <div class="flex justify-center items-center mb-8">
                    <div class="flex items-center">
                        <div class="progress-step active">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="progress-line active"></div>
                        <div class="progress-step">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div class="progress-line"></div>
                        <div class="progress-step">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-white relative z-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div>
                    <h2 class="text-3xl font-bold text-[var(--primary-color)] mb-6 relative inline-block">
                        Connect With Us
                        <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-[var(--accent-color)]"></span>
                    </h2>
                    <p class="text-gray-600 mb-8">At Grocery Station One (GSO), we value our customers and are always ready to assist you. Whether you have questions about our products, need help with an order, or want to provide feedback, we're here to help.</p>
                    
                    <div class="space-y-6">
                        <!-- Contact Info Card 1 -->
                        <div class="contact-card bg-white rounded-xl p-6 border-l-4 border-[var(--primary-color)] shadow-md">
                            <div class="flex items-start">
                                <div class="bg-[var(--primary-color)] bg-opacity-20 p-3 rounded-full mr-4">
                                    <i class="fas fa-map-marker-alt text-[var(--primary-color)] text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-[var(--primary-color)] mb-1">Our Store</h3>
                                    <p class="text-gray-600">Jodia Bazar, Karachi,
Pakistan</p>
                                    <p class="text-gray-600 mt-1">Open Monday-Saturday: 8am-10pm, Sunday: 9am-8pm</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Info Card 2 -->
                        <div class="contact-card bg-white rounded-xl p-6 border-l-4 border-[var(--secondary-color)] shadow-md">
                            <div class="flex items-start">
                                <div class="bg-[var(--secondary-color)] bg-opacity-20 p-3 rounded-full mr-4">
                                    <i class="fas fa-phone-alt text-[var(--secondary-color)] text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-[var(--primary-color)] mb-1">Phone & WhatsApp</h3>
                                    {{-- <p class="text-gray-600">Main: (555) 123-4567</p> --}}
                                    {{-- <p class="text-gray-600">Delivery: (555) 123-4568</p> --}}
                                    <p class="text-gray-600">WhatsApp: +92 318 8270460</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Info Card 3 -->
                        <div class="contact-card bg-white rounded-xl p-6 border-l-4 border-[var(--accent-color)] shadow-md">
                            <div class="flex items-start">
                                <div class="bg-[var(--accent-color)] bg-opacity-20 p-3 rounded-full mr-4">
                                    <i class="fas fa-envelope text-[var(--accent-color)] text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-[var(--primary-color)] mb-1">Email Us</h3>
                                    <p class="text-gray-600">General Inquiries: info@grocerystationone.com</p>
                                    <p class="text-gray-600">Customer Support: support@grocerystationone.com</p>
                                    <p class="text-gray-600">Delivery Issues: delivery@grocerystationone.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
          
                    
                    <!-- Social Media -->
                    <div class="mt-10">
                        <h3 class="font-bold text-xl text-[var(--primary-color)] mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-gray-100 text-[var(--primary-color)] p-3 rounded-full hover:bg-[var(--primary-color)] hover:text-white transition transform hover:scale-110">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="bg-gray-100 text-[var(--primary-color)] p-3 rounded-full hover:bg-[var(--primary-color)] hover:text-white transition transform hover:scale-110">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.instagram.com/grocerystationone?igsh=NWJxMDIya3dsYXU5"  target="_blank" aria-colcount=""class="bg-gray-100 text-[var(--primary-color)] p-3 rounded-full hover:bg-[var(--primary-color)] hover:text-white transition transform hover:scale-110">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="bg-gray-100 text-[var(--primary-color)] p-3 rounded-full hover:bg-[var(--primary-color)] hover:text-white transition transform hover:scale-110">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 border border-gray-100 shadow-lg relative overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[var(--primary-color)] rounded-full -mr-16 -mt-16 opacity-10"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-[var(--accent-color)] rounded-full -ml-12 -mb-12 opacity-10"></div>
                    
                    <h2 class="text-3xl font-bold text-[var(--primary-color)] mb-2 relative z-10">Send Us a Message</h2>
                    <p class="text-gray-600 mb-6 relative z-10">Fill out the form below and we'll get back to you within 24 hours.</p>
                    
                    <form id="contact-form" class="space-y-6 relative z-10">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <input type="text" id="first-name" name="first_name" placeholder=" " 
                                    class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]" required>
                                <label for="first-name" class="form-label">First Name</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="last-name" name="last_name" placeholder=" "
                                    class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
                                <label for="last-name" class="form-label">Last Name</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder=" "
                                class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]" required>
                            <label for="email" class="form-label">Email Address</label>
                        </div>

                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" placeholder=" "
                                class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
                            <label for="phone" class="form-label">Phone Number</label>
                        </div>

                        <div class="form-group">
                            <select id="subject" name="subject"
                                class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]" required>
                                <option value="" disabled selected>Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="order">Order Issue</option>
                                <option value="delivery">Delivery Problem</option>
                                <option value="product">Product Feedback</option>
                                <option value="complaint">Complaint</option>
                                <option value="other">Other</option>
                            </select>
                            <label for="subject" class="form-label">Subject</label>
                        </div>

                        <div class="form-group">
                            <textarea id="message" name="message" rows="5" placeholder=" "
                                class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]"
                                required></textarea>
                            <label for="message" class="form-label">Your Message</label>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[var(--accent-color)] to-[var(--accent-hover)] text-white font-bold py-4 px-6 rounded-lg hover:shadow-lg transition-all transform hover:-translate-y-1 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                        
                        <p class="text-center text-gray-500 text-sm mt-4">
                            <i class="fas fa-shield-alt mr-1"></i> Your information is secure and will never be shared with third parties.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    {{-- <section class="py-16 gradient-bg">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-[var(--primary-color)] mb-2">Frequently Asked Questions</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Quick answers to common questions. Can't find what you're looking for? <a href="#contact-form" class="text-[var(--accent-color)] font-medium">Send us a message</a>.</p>
            
            <div class="max-w-3xl mx-auto space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <button class="faq-question w-full text-left p-6 font-medium text-[var(--primary-color)] flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="text-lg">What are your delivery hours and areas?</span>
                        <i class="fas fa-chevron-down text-[var(--accent-color)]"></i>
                    </button>
                    <div class="faq-answer p-6 pt-0 text-gray-600">
                        We deliver from 8 AM to 10 PM daily, including weekends. Our delivery service covers a 15-mile radius from our store location. Orders placed before 2 PM will be delivered the same day, while orders after 2 PM will be delivered the next day.
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <button class="faq-question w-full text-left p-6 font-medium text-[var(--primary-color)] flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="text-lg">Do you offer organic and specialty products?</span>
                        <i class="fas fa-chevron-down text-[var(--accent-color)]"></i>
                    </button>
                    <div class="faq-answer p-6 pt-0 text-gray-600">
                        Yes, we have a wide selection of organic fruits, vegetables, and pantry items. We also carry gluten-free, vegan, and other specialty products. You can filter by these categories on our website or ask our staff for assistance.
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <button class="faq-question w-full text-left p-6 font-medium text-[var(--primary-color)] flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="text-lg">What is your return policy for perishable items?</span>
                        <i class="fas fa-chevron-down text-[var(--accent-color)]"></i>
                    </button>
                    <div class="faq-answer p-6 pt-0 text-gray-600">
                        We guarantee the freshness of all our products. If you're not satisfied with the quality of any perishable item, please contact us within 24 hours of delivery with photos of the product, and we'll issue a full refund or replacement.
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <button class="faq-question w-full text-left p-6 font-medium text-[var(--primary-color)] flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="text-lg">How can I track my order?</span>
                        <i class="fas fa-chevron-down text-[var(--accent-color)]"></i>
                    </button>
                    <div class="faq-answer p-6 pt-0 text-gray-600">
                        Once your order is confirmed and out for delivery, you'll receive a tracking link via SMS and email. You can also track your order by logging into your account on our website and checking the order status in your dashboard.
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Map & Store Info Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-[var(--primary-color)] mb-2">Visit Our Store</h2>
            <p class="text-center text-gray-600 mb-12">Come see us in person and experience our fresh products</p>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Store Information -->
                <div class="lg:col-span-1">
                    <div class="bg-gradient-to-br from-[var(--primary-color)] to-[var(--secondary-color)] rounded-2xl p-6 text-white h-full">
                        <h3 class="text-2xl font-bold mb-4">Store Details</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="bg-white bg-opacity-20 p-2 rounded-full mr-3 mt-1">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">Opening Hours</h4>
                                    <p>Monday - Saturday: 8:00 AM - 10:00 PM</p>
                                    <p>Sunday: 9:00 AM - 8:00 PM</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-white bg-opacity-20 p-2 rounded-full mr-3 mt-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">Address</h4>
                                    {{-- <p>123 Grocery Street</p> --}}
                                    <p>Jodia Bazar, Karachi,
Pakistan</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-white bg-opacity-20 p-2 rounded-full mr-3 mt-1">
                                    <i class="fas fa-car"></i>
                                </div>
                                {{-- <div>
                                    <h4 class="font-bold">Parking</h4>
                                    <p>Free parking available</p>
                                    <p>20+ dedicated spots</p>
                                </div> --}}
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-white bg-opacity-20 p-2 rounded-full mr-3 mt-1">
                                    <i class="fas fa-wheelchair"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">Accessibility</h4>
                                    <p>Wheelchair accessible</p>
                                    <p>Elevators available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="lg:col-span-2">
  <div class="bg-gray-100 rounded-2xl overflow-hidden h-96 relative">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28935.268541767046!2d67.0011!3d24.8607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f8ef56c64a1%3A0x7c19b1b55dff1d0f!2sKarachi%2C%20Pakistan!5e0!3m2!1sen!2s!4v1697897899999!5m2!1sen!2s"
      width="100%"
      height="100%"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
      class="rounded-2xl"
    ></iframe>

    <!-- Map Controls (still keep them if you want custom icons) -->
    <div class="absolute bottom-4 right-4 flex space-x-2">
      <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition">
        <i class="fas fa-plus text-gray-700"></i>
      </button>
      <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition">
        <i class="fas fa-minus text-gray-700"></i>
      </button>
      <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition">
        <i class="fas fa-location-arrow text-gray-700"></i>
      </button>
    </div>
  </div>
</div>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-[var(--primary-color)] to-[var(--secondary-color)] text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Still Have Questions?</h2>
            <p class="text-xl max-w-2xl mx-auto mb-8">Our customer service team is here to help you with any inquiries you might have.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="tel:5551234567" class="bg-white text-[var(--primary-color)] font-bold py-3 px-8 rounded-lg hover:bg-opacity-90 transition flex items-center justify-center">
                    <i class="fas fa-phone-alt mr-2"></i> Call Us Now
                </a>
                <a href="#contact-form" class="bg-transparent border-2 border-white text-white font-bold py-3 px-8 rounded-lg hover:bg-white hover:bg-opacity-10 transition flex items-center justify-center">
                    <i class="fas fa-envelope mr-2"></i> Send Message
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@push("script")
<script>
$(document).ready(function () {
    // Form submission with progress steps
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();

        // Update progress steps
        $('.progress-step').eq(2).addClass('active');
        $('.progress-line').eq(1).addClass('active');

        const formData = new FormData(this);
        $.ajax({
            url: "{{ route('contact.store') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                Swal.fire({
                    title: 'Sending...',
                    text: 'Please wait while we send your message.',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    text: response.message ?? 'Your message has been sent successfully!',
                    confirmButtonColor: 'var(--accent-color)'
                });
                $('#contact-form')[0].reset();
                
                // Reset progress steps
                setTimeout(() => {
                    $('.progress-step').removeClass('active');
                    $('.progress-line').removeClass('active');
                    $('.progress-step').eq(0).addClass('active');
                }, 2000);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                let msg = 'Something went wrong. Please try again later.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    msg = Object.values(xhr.responseJSON.errors).join('\n');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: msg,
                    confirmButtonColor: '#dc2626'
                });
                
                // Reset progress steps on error
                $('.progress-step').eq(2).removeClass('active');
                $('.progress-line').eq(1).removeClass('active');
            }
        });
    });

    // FAQ Toggle with smooth animation
    $('.faq-question').on('click', function() {
        const $answer = $(this).next('.faq-answer');
        const $icon = $(this).find('i');
        
        // Close all other FAQs
        $('.faq-answer').not($answer).removeClass('active');
        $('.faq-question').not(this).removeClass('active').find('i').css('transform', 'rotate(0deg)');
        
        // Toggle current FAQ
        $answer.toggleClass('active');
        $(this).toggleClass('active');
        
        if ($answer.hasClass('active')) {
            $icon.css('transform', 'rotate(180deg)');
        } else {
            $icon.css('transform', 'rotate(0deg)');
        }
    });

    $('.form-input').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        if ($(this).val() === '') {
            $(this).parent().removeClass('focused');
        }
    });

    $('.progress-step').eq(0).addClass('active');
});
</script>
@endpush