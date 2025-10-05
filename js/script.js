// ===== GLOBAL VARIABLES =====
let isNavbarScrolled = false;

// ===== DOCUMENT READY =====
document.addEventListener('DOMContentLoaded', function() {
    initializeNavbar();
    initializeSmoothScrolling();
    initializeAnimations();
    initializeFormValidation();
    setActiveNavLink();
    
    console.log('Sanggar Tari Tatra KJD - Website loaded successfully!');
});

// ===== NAVBAR FUNCTIONS =====
function initializeNavbar() {
    const navbar = document.querySelector('.navbar-custom');
    
    // Handle navbar scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50 && !isNavbarScrolled) {
            navbar.classList.add('scrolled');
            isNavbarScrolled = true;
        } else if (window.scrollY <= 50 && isNavbarScrolled) {
            navbar.classList.remove('scrolled');
            isNavbarScrolled = false;
        }
    });
    
    // Handle mobile menu close on link click
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                navbarCollapse.classList.remove('show');
            }
        });
    });
}

function setActiveNavLink() {
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        
        if (href === currentPage || 
            (currentPage === '' && href === 'index.html') ||
            (currentPage === 'index.html' && href === 'index.html')) {
            link.classList.add('active');
        }
    });
}

// ===== SMOOTH SCROLLING =====
function initializeSmoothScrolling() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            
            if (target) {
                const navbarHeight = document.querySelector('.navbar-custom').offsetHeight;
                const targetPosition = target.offsetTop - navbarHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Scroll indicator functionality
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            const nextSection = document.querySelector('.quick-info-section') || 
                              document.querySelector('.content-section');
            if (nextSection) {
                nextSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
        
        // Hide scroll indicator after scrolling
        window.addEventListener('scroll', function() {
            if (window.scrollY > 200) {
                scrollIndicator.style.opacity = '0';
            } else {
                scrollIndicator.style.opacity = '1';
            }
        });
    }
}

// ===== ANIMATIONS =====
function initializeAnimations() {
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animateElements = document.querySelectorAll('.quick-info-card, .class-card, .card-custom');
    animateElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'all 0.8s ease';
        observer.observe(element);
    });
    
    // Enhanced hover effects for cards
    document.querySelectorAll('.quick-info-card, .class-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
}

// ===== FORM VALIDATION =====
function initializeFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                showFormErrors(form);
            }
            form.classList.add('was-validated');
        });
        
        // Real-time validation
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });
    });
}

function validateField(field) {
    const feedback = field.parentNode.querySelector('.invalid-feedback');
    
    if (!field.checkValidity()) {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        
        if (feedback) {
            feedback.style.display = 'block';
        }
    } else {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        
        if (feedback) {
            feedback.style.display = 'none';
        }
    }
}

function showFormErrors(form) {
    const invalidFields = form.querySelectorAll(':invalid');
    if (invalidFields.length > 0) {
        invalidFields[0].focus();
        showNotification('Mohon lengkapi semua field yang wajib diisi', 'error');
    }
}

// ===== NOTIFICATION SYSTEM =====
function showNotification(message, type = 'info') {
    // Remove existing notification
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${getNotificationIcon(type)}"></i>
            <span>${message}</span>
            <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${getNotificationColor(type)};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        z-index: 9999;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        max-width: 400px;
    `;
    
    // Add to DOM
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 300);
        }
    }, 5000);
}

function getNotificationIcon(type) {
    const icons = {
        'success': 'check-circle',
        'error': 'exclamation-circle',
        'warning': 'exclamation-triangle',
        'info': 'info-circle'
    };
    return icons[type] || 'info-circle';
}

function getNotificationColor(type) {
    const colors = {
        'success': '#28a745',
        'error': '#dc3545',
        'warning': '#ffc107',
        'info': '#17a2b8'
    };
    return colors[type] || '#17a2b8';
}

// ===== UTILITY FUNCTIONS =====
function showLoading(element) {
    if (element) {
        element.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        element.disabled = true;
    }
}

function hideLoading(element, originalText) {
    if (element) {
        element.innerHTML = originalText;
        element.disabled = false;
    }
}

function formatPhoneNumber(phone) {
    // Format Indonesian phone number
    let formatted = phone.replace(/\D/g, '');
    if (formatted.startsWith('0')) {
        formatted = '62' + formatted.substring(1);
    }
    if (!formatted.startsWith('62')) {
        formatted = '62' + formatted;
    }
    return formatted;
}

function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePhone(phone) {
    const phoneRegex = /^(\+62|62|0)[0-9]{9,12}$/;
    return phoneRegex.test(phone);
}

// ===== MODAL FUNCTIONS =====
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) {
            bsModal.hide();
        }
    }
}

// ===== BOOKING FUNCTIONS =====
function bookClass(className, schedule, instructor) {
    showNotification(`Anda akan mendaftar untuk ${className} dengan ${instructor} pada ${schedule}`, 'info');
    
    // Redirect to reservation page with parameters
    const params = new URLSearchParams({
        class: className,
        schedule: schedule,
        instructor: instructor
    });
    
    window.location.href = `pages/reservasi.html?${params.toString()}`;
}

// ===== RESERVATION FORM FUNCTIONS =====
function initializeReservationForm() {
    const form = document.getElementById('reservationForm');
    if (!form) return;
    
    // Load URL parameters to pre-fill form
    loadBookingParameters();
    
    // Add form submission handler
    form.addEventListener('submit', handleReservationSubmit);
    
    // Add real-time validation
    addReservationValidation();
    
    console.log('Reservation form initialized');
}

function loadBookingParameters() {
    const urlParams = new URLSearchParams(window.location.search);
    const className = urlParams.get('class');
    const schedule = urlParams.get('schedule');
    const instructor = urlParams.get('instructor');
    
    if (className) {
        const classSelect = document.getElementById('bookingClass');
        if (classSelect) {
            // Create option if not exists
            let optionExists = false;
            for (let option of classSelect.options) {
                if (option.value === className) {
                    option.selected = true;
                    optionExists = true;
                    break;
                }
            }
            if (!optionExists) {
                const newOption = new Option(className, className, true, true);
                classSelect.add(newOption);
            }
        }
    }
    
    if (schedule) {
        const scheduleSelect = document.getElementById('bookingSchedule');
        if (scheduleSelect) {
            let optionExists = false;
            for (let option of scheduleSelect.options) {
                if (option.value === schedule) {
                    option.selected = true;
                    optionExists = true;
                    break;
                }
            }
            if (!optionExists) {
                const newOption = new Option(schedule, schedule, true, true);
                scheduleSelect.add(newOption);
            }
        }
    }
}

function addReservationValidation() {
    const form = document.getElementById('reservationForm');
    if (!form) return;
    
    const inputs = form.querySelectorAll('input, select, textarea');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateBookingField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateBookingField(this);
            }
        });
    });
    
    // Special validation for phone number
    const phoneInput = document.getElementById('bookingPhone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            // Auto format phone number
            let value = this.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            }
            if (value.length > 13) {
                value = value.substring(0, 13);
            }
            this.value = value;
        });
    }
    
    // Email validation
    const emailInput = document.getElementById('bookingEmail');
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            if (this.value && !validateEmail(this.value)) {
                this.setCustomValidity('Email tidak valid');
                this.classList.add('is-invalid');
            } else {
                this.setCustomValidity('');
                this.classList.remove('is-invalid');
                if (this.value) this.classList.add('is-valid');
            }
        });
    }
}

function validateBookingField(field) {
    const fieldName = field.name || field.id;
    let isValid = true;
    let errorMessage = '';
    
    // Required field validation
    if (field.hasAttribute('required') && !field.value.trim()) {
        isValid = false;
        errorMessage = 'Field ini wajib diisi';
    }
    
    // Specific field validations
    switch (fieldName) {
        case 'bookingEmail':
            if (field.value && !validateEmail(field.value)) {
                isValid = false;
                errorMessage = 'Format email tidak valid';
            }
            break;
            
        case 'bookingPhone':
            if (field.value && !validatePhone(field.value)) {
                isValid = false;
                errorMessage = 'Nomor telepon tidak valid (gunakan format: 628xxxxxxxxx)';
            }
            break;
            
        case 'bookingName':
            if (field.value && field.value.length < 2) {
                isValid = false;
                errorMessage = 'Nama minimal 2 karakter';
            }
            break;
            
        case 'bookingAge':
            const age = parseInt(field.value);
            if (field.value && (age < 5 || age > 80)) {
                isValid = false;
                errorMessage = 'Usia harus antara 5-80 tahun';
            }
            break;
    }
    
    // Update field appearance
    if (isValid) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        field.setCustomValidity('');
    } else {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        field.setCustomValidity(errorMessage);
    }
    
    // Update error message
    const feedback = field.parentNode.querySelector('.invalid-feedback');
    if (feedback) {
        feedback.textContent = errorMessage;
    }
    
    return isValid;
}

function handleReservationSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    
    // Validate all fields
    let isFormValid = true;
    const inputs = form.querySelectorAll('input, select, textarea');
    
    inputs.forEach(input => {
        if (!validateBookingField(input)) {
            isFormValid = false;
        }
    });
    
    if (!isFormValid) {
        showNotification('Mohon perbaiki kesalahan pada form', 'error');
        return;
    }
    
    // Prepare booking data
    const bookingData = {
        id: generateBookingId(),
        name: formData.get('bookingName'),
        email: formData.get('bookingEmail'),
        phone: formData.get('bookingPhone'),
        age: formData.get('bookingAge'),
        class: formData.get('bookingClass'),
        schedule: formData.get('bookingSchedule'),
        experience: formData.get('bookingExperience'),
        notes: formData.get('bookingNotes'),
        timestamp: new Date().toISOString(),
        status: 'pending',
        paymentStatus: 'unpaid'
    };
    
    // Show confirmation popup
    showBookingConfirmation(bookingData);
}

function generateBookingId() {
    const timestamp = Date.now().toString();
    const random = Math.random().toString(36).substring(2, 8).toUpperCase();
    return `BK${timestamp.slice(-6)}${random}`;
}

function showBookingConfirmation(bookingData) {
    // Create modal HTML
    const modalHTML = `
        <div class="modal fade" id="bookingConfirmationModal" tabindex="-1" aria-labelledby="bookingConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="bookingConfirmationModalLabel">
                            <i class="fas fa-check-circle me-2"></i>Konfirmasi Reservasi
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-calendar-check text-success" style="font-size: 3rem;"></i>
                            <h4 class="mt-3 text-success">Konfirmasi Data Reservasi</h4>
                            <p class="text-muted">Mohon periksa kembali data Anda sebelum melanjutkan</p>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="confirmation-item">
                                    <strong>ID Booking:</strong>
                                    <span class="text-primary">${bookingData.id}</span>
                                </div>
                                <div class="confirmation-item">
                                    <strong>Nama Lengkap:</strong>
                                    <span>${bookingData.name}</span>
                                </div>
                                <div class="confirmation-item">
                                    <strong>Email:</strong>
                                    <span>${bookingData.email}</span>
                                </div>
                                <div class="confirmation-item">
                                    <strong>Telepon:</strong>
                                    <span>${bookingData.phone}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="confirmation-item">
                                    <strong>Usia:</strong>
                                    <span>${bookingData.age} tahun</span>
                                </div>
                                <div class="confirmation-item">
                                    <strong>Kelas:</strong>
                                    <span class="badge bg-warning text-dark">${bookingData.class}</span>
                                </div>
                                <div class="confirmation-item">
                                    <strong>Jadwal:</strong>
                                    <span>${bookingData.schedule}</span>
                                </div>
                                <div class="confirmation-item">
                                    <strong>Pengalaman:</strong>
                                    <span>${bookingData.experience}</span>
                                </div>
                            </div>
                        </div>
                        
                        ${bookingData.notes ? `
                            <div class="mt-3">
                                <strong>Catatan Tambahan:</strong>
                                <div class="bg-light p-3 rounded">${bookingData.notes}</div>
                            </div>
                        ` : ''}
                        
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Informasi Penting:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Reservasi akan diproses dalam 1x24 jam</li>
                                <li>Konfirmasi akan dikirim melalui email dan WhatsApp</li>
                                <li>Pembayaran dapat dilakukan setelah konfirmasi dari admin</li>
                                <li>Batas pembayaran 3 hari setelah konfirmasi</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-arrow-left me-2"></i>Kembali Edit
                        </button>
                        <button type="button" class="btn btn-success" onclick="confirmReservation('${bookingData.id}')">
                            <i class="fas fa-check me-2"></i>Konfirmasi Reservasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal if any
    const existingModal = document.getElementById('bookingConfirmationModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Add modal to DOM
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Store booking data temporarily
    sessionStorage.setItem('tempBookingData', JSON.stringify(bookingData));
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('bookingConfirmationModal'));
    modal.show();
    
    // Add custom styles
    const style = document.createElement('style');
    style.textContent = `
        .confirmation-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        .confirmation-item:last-child {
            border-bottom: none;
        }
        .confirmation-item strong {
            color: #495057;
            min-width: 120px;
        }
        .confirmation-item span {
            text-align: right;
            font-weight: 500;
        }
    `;
    document.head.appendChild(style);
}

function confirmReservation(bookingId) {
    const tempData = sessionStorage.getItem('tempBookingData');
    if (!tempData) {
        showNotification('Data booking tidak ditemukan', 'error');
        return;
    }
    
    const bookingData = JSON.parse(tempData);
    
    // Save to localStorage
    const success = saveBookingToStorage(bookingData);
    
    if (success) {
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('bookingConfirmationModal'));
        modal.hide();
        
        // Clear temp data
        sessionStorage.removeItem('tempBookingData');
        
        // Show success notification
        showNotification(`Reservasi berhasil disimpan dengan ID: ${bookingId}`, 'success');
        
        // Reset form
        const form = document.getElementById('reservationForm');
        if (form) {
            form.reset();
            form.classList.remove('was-validated');
            
            // Remove validation classes
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
        }
        
        // Show booking details
        setTimeout(() => {
            showBookingSuccess(bookingData);
        }, 1000);
        
    } else {
        showNotification('Gagal menyimpan reservasi. Silakan coba lagi.', 'error');
    }
}

function saveBookingToStorage(bookingData) {
    try {
        // Get existing bookings
        let bookings = getFromLocalStorage('bookings') || [];
        
        // Add new booking
        bookings.push(bookingData);
        
        // Save back to localStorage
        const success = saveToLocalStorage('bookings', bookings);
        
        if (success) {
            // Update booking statistics
            updateBookingStats();
            
            // Log for admin
            console.log('New booking saved:', bookingData);
            
            return true;
        }
        
        return false;
    } catch (error) {
        console.error('Error saving booking:', error);
        return false;
    }
}

function updateBookingStats() {
    try {
        const bookings = getFromLocalStorage('bookings') || [];
        
        const stats = {
            total: bookings.length,
            pending: bookings.filter(b => b.status === 'pending').length,
            confirmed: bookings.filter(b => b.status === 'confirmed').length,
            completed: bookings.filter(b => b.status === 'completed').length,
            cancelled: bookings.filter(b => b.status === 'cancelled').length,
            lastUpdated: new Date().toISOString()
        };
        
        saveToLocalStorage('bookingStats', stats);
        
        // Update UI if stats elements exist
        updateStatsDisplay(stats);
        
    } catch (error) {
        console.error('Error updating booking stats:', error);
    }
}

function updateStatsDisplay(stats) {
    const totalElement = document.getElementById('totalBookings');
    if (totalElement) {
        totalElement.textContent = stats.total;
    }
    
    const pendingElement = document.getElementById('pendingBookings');
    if (pendingElement) {
        pendingElement.textContent = stats.pending;
    }
}

function showBookingSuccess(bookingData) {
    const successHTML = `
        <div class="modal fade" id="bookingSuccessModal" tabindex="-1" aria-labelledby="bookingSuccessModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="bookingSuccessModalLabel">
                            <i class="fas fa-check-circle me-2"></i>Reservasi Berhasil!
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h4 class="mt-3 text-success">Terima Kasih!</h4>
                        <p class="text-muted">Reservasi Anda telah berhasil disimpan</p>
                        
                        <div class="alert alert-success">
                            <strong>ID Booking: ${bookingData.id}</strong><br>
                            <small>Simpan ID ini untuk referensi Anda</small>
                        </div>
                        
                        <div class="text-start">
                            <h6>Langkah Selanjutnya:</h6>
                            <ol>
                                <li>Admin akan menghubungi Anda dalam 1x24 jam</li>
                                <li>Konfirmasi jadwal dan pembayaran</li>
                                <li>Lakukan pembayaran sesuai instruksi</li>
                                <li>Datang sesuai jadwal yang telah disepakati</li>
                            </ol>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="sendToWhatsApp('${bookingData.id}')">
                            <i class="fab fa-whatsapp me-2"></i>Chat Admin
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal if any
    const existingModal = document.getElementById('bookingSuccessModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Add modal to DOM
    document.body.insertAdjacentHTML('beforeend', successHTML);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('bookingSuccessModal'));
    modal.show();
}

function sendToWhatsApp(bookingId) {
    const bookings = getFromLocalStorage('bookings') || [];
    const booking = bookings.find(b => b.id === bookingId);
    
    if (!booking) {
        showNotification('Data booking tidak ditemukan', 'error');
        return;
    }
    
    const message = `Halo Admin Sanggar Tari Tatra KJD,

Saya baru saja melakukan reservasi dengan detail:

📋 ID Booking: ${booking.id}
👤 Nama: ${booking.name}
📧 Email: ${booking.email}
📱 HP: ${booking.phone}
🎭 Kelas: ${booking.class}
📅 Jadwal: ${booking.schedule}
📊 Pengalaman: ${booking.experience}

Mohon konfirmasi untuk langkah selanjutnya.

Terima kasih!`;
    
    const phoneNumber = '6281234567890'; // Replace with actual admin WhatsApp number
    const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
    
    window.open(whatsappURL, '_blank');
}

// ===== BOOKING MANAGEMENT FUNCTIONS =====
function getAllBookings() {
    return getFromLocalStorage('bookings') || [];
}

function getBookingById(bookingId) {
    const bookings = getAllBookings();
    return bookings.find(booking => booking.id === bookingId);
}

function updateBookingStatus(bookingId, newStatus) {
    try {
        const bookings = getAllBookings();
        const bookingIndex = bookings.findIndex(booking => booking.id === bookingId);
        
        if (bookingIndex === -1) {
            throw new Error('Booking not found');
        }
        
        bookings[bookingIndex].status = newStatus;
        bookings[bookingIndex].lastUpdated = new Date().toISOString();
        
        saveToLocalStorage('bookings', bookings);
        updateBookingStats();
        
        return true;
    } catch (error) {
        console.error('Error updating booking status:', error);
        return false;
    }
}

function deleteBooking(bookingId) {
    try {
        const bookings = getAllBookings();
        const filteredBookings = bookings.filter(booking => booking.id !== bookingId);
        
        saveToLocalStorage('bookings', filteredBookings);
        updateBookingStats();
        
        return true;
    } catch (error) {
        console.error('Error deleting booking:', error);
        return false;
    }
}

// Initialize reservation form when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeReservationForm();
});

// ===== LOCAL STORAGE FUNCTIONS =====
function saveToLocalStorage(key, data) {
    try {
        localStorage.setItem(key, JSON.stringify(data));
        return true;
    } catch (error) {
        console.error('Error saving to localStorage:', error);
        return false;
    }
}

function getFromLocalStorage(key) {
    try {
        const data = localStorage.getItem(key);
        return data ? JSON.parse(data) : null;
    } catch (error) {
        console.error('Error reading from localStorage:', error);
        return null;
    }
}

function removeFromLocalStorage(key) {
    try {
        localStorage.removeItem(key);
        return true;
    } catch (error) {
        console.error('Error removing from localStorage:', error);
        return false;
    }
}

// ===== SEARCH FUNCTIONS =====
function searchClasses(query) {
    const classCards = document.querySelectorAll('.class-card');
    const searchTerm = query.toLowerCase().trim();
    
    classCards.forEach(card => {
        const className = card.querySelector('h5').textContent.toLowerCase();
        const classDescription = card.querySelector('p').textContent.toLowerCase();
        
        if (className.includes(searchTerm) || classDescription.includes(searchTerm)) {
            card.style.display = 'block';
            card.classList.add('fade-in');
        } else {
            card.style.display = 'none';
        }
    });
}

// ===== ADMIN BOOKING SEARCH & FILTER =====
function searchBookings(query) {
    const bookings = getAllBookings();
    const searchTerm = query.toLowerCase().trim();
    
    const filteredBookings = bookings.filter(booking => {
        return booking.name.toLowerCase().includes(searchTerm) ||
               booking.email.toLowerCase().includes(searchTerm) ||
               booking.phone.includes(searchTerm) ||
               booking.class.toLowerCase().includes(searchTerm) ||
               booking.id.toLowerCase().includes(searchTerm);
    });
    
    updateBookingTable(filteredBookings);
    return filteredBookings;
}

function filterBookingsByStatus(status) {
    const bookings = getAllBookings();
    
    const filteredBookings = status ? 
        bookings.filter(booking => booking.status === status) : 
        bookings;
    
    updateBookingTable(filteredBookings);
    return filteredBookings;
}

function updateBookingTable(bookings) {
    const tbody = document.getElementById('bookingsTable');
    if (!tbody) return;
    
    if (bookings.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    <i class="fas fa-search me-2"></i>Tidak ada data booking yang ditemukan
                </td>
            </tr>
        `;
        return;
    }
    
    tbody.innerHTML = bookings.map(booking => `
        <tr>
            <td>${booking.id}</td>
            <td>${booking.name}</td>
            <td>${booking.class}</td>
            <td>${formatDate(booking.timestamp)}</td>
            <td>${booking.schedule}</td>
            <td>${getClassPrice(booking.class)}</td>
            <td>
                <span class="status-badge status-${booking.status}">
                    ${getStatusText(booking.status)}
                </span>
            </td>
            <td>
                <button class="action-btn btn-view" onclick="viewBookingDetails('${booking.id}')" title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                </button>
                ${booking.status === 'pending' || booking.status === 'confirmed' ? `
                    <button class="action-btn btn-confirm" onclick="showPaymentConfirmation('${booking.id}')" title="Konfirmasi Pembayaran">
                        <i class="fas fa-credit-card"></i>
                    </button>
                ` : ''}
                <button class="action-btn btn-edit" onclick="editBookingStatus('${booking.id}')" title="Edit Status">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn btn-delete" onclick="deleteBookingConfirmation('${booking.id}')" title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function getStatusText(status) {
    const statusMap = {
        'pending': 'Pending',
        'confirmed': 'Confirmed', 
        'paid': 'Paid',
        'completed': 'Completed',
        'cancelled': 'Cancelled'
    };
    return statusMap[status] || status;
}

function getClassPrice(className) {
    const priceMap = {
        'Tari Saman': 'Rp 150.000',
        'Tari Jaipong': 'Rp 200.000',
        'Tari Kecak': 'Rp 250.000',
        'Kelas Privat': 'Rp 350.000',
        'Workshop Tari Bali': 'Rp 500.000'
    };
    return priceMap[className] || 'Rp 150.000';
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID');
}

// ===== BOOKING DETAIL FUNCTIONS =====
function viewBookingDetails(bookingId) {
    const booking = getBookingById(bookingId);
    if (!booking) {
        showNotification('Data booking tidak ditemukan', 'error');
        return;
    }
    
    const modalHTML = `
        <div class="modal fade" id="bookingDetailModal" tabindex="-1" aria-labelledby="bookingDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="bookingDetailModalLabel">
                            <i class="fas fa-info-circle me-2"></i>Detail Booking
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary">Informasi Peserta</h6>
                                <table class="table table-borderless">
                                    <tr><td><strong>ID Booking:</strong></td><td>${booking.id}</td></tr>
                                    <tr><td><strong>Nama:</strong></td><td>${booking.name}</td></tr>
                                    <tr><td><strong>Email:</strong></td><td>${booking.email}</td></tr>
                                    <tr><td><strong>Telepon:</strong></td><td>${booking.phone}</td></tr>
                                    <tr><td><strong>Usia:</strong></td><td>${booking.age} tahun</td></tr>
                                    <tr><td><strong>Pengalaman:</strong></td><td>${booking.experience}</td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-primary">Informasi Kelas</h6>
                                <table class="table table-borderless">
                                    <tr><td><strong>Kelas:</strong></td><td>${booking.class}</td></tr>
                                    <tr><td><strong>Jadwal:</strong></td><td>${booking.schedule}</td></tr>
                                    <tr><td><strong>Harga:</strong></td><td>${getClassPrice(booking.class)}</td></tr>
                                    <tr><td><strong>Status:</strong></td><td>
                                        <span class="status-badge status-${booking.status}">
                                            ${getStatusText(booking.status)}
                                        </span>
                                    </td></tr>
                                    <tr><td><strong>Tanggal Booking:</strong></td><td>${formatDate(booking.timestamp)}</td></tr>
                                    <tr><td><strong>Pembayaran:</strong></td><td>
                                        <span class="status-badge status-${booking.paymentStatus || 'unpaid'}">
                                            ${booking.paymentStatus === 'paid' ? 'Lunas' : 'Belum Lunas'}
                                        </span>
                                    </td></tr>
                                </table>
                            </div>
                        </div>
                        
                        ${booking.notes ? `
                            <div class="mt-3">
                                <h6 class="text-primary">Catatan Tambahan</h6>
                                <div class="bg-light p-3 rounded">${booking.notes}</div>
                            </div>
                        ` : ''}
                        
                        <div class="mt-3">
                            <h6 class="text-primary">Riwayat Status</h6>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <i class="fas fa-plus-circle text-primary"></i>
                                    <span>Booking dibuat - ${formatDate(booking.timestamp)}</span>
                                </div>
                                ${booking.lastUpdated ? `
                                    <div class="timeline-item">
                                        <i class="fas fa-edit text-warning"></i>
                                        <span>Status terakhir diupdate - ${formatDate(booking.lastUpdated)}</span>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="showPaymentConfirmation('${booking.id}')">
                            <i class="fas fa-credit-card me-2"></i>Konfirmasi Pembayaran
                        </button>
                        <button type="button" class="btn btn-warning" onclick="editBookingStatus('${booking.id}')">
                            <i class="fas fa-edit me-2"></i>Edit Status
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal
    const existingModal = document.getElementById('bookingDetailModal');
    if (existingModal) existingModal.remove();
    
    // Add and show modal
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    const modal = new bootstrap.Modal(document.getElementById('bookingDetailModal'));
    modal.show();
    
    // Add timeline styles
    const style = document.createElement('style');
    style.textContent = `
        .timeline-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            border-left: 2px solid #dee2e6;
            padding-left: 1rem;
            margin-left: 0.5rem;
            position: relative;
        }
        .timeline-item i {
            position: absolute;
            left: -8px;
            background: white;
            padding: 2px;
        }
    `;
    document.head.appendChild(style);
}

function showPaymentConfirmation(bookingId) {
    const booking = getBookingById(bookingId);
    if (!booking) {
        showNotification('Data booking tidak ditemukan', 'error');
        return;
    }
    
    const modalHTML = `
        <div class="modal fade" id="paymentConfirmationModal" tabindex="-1" aria-labelledby="paymentConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="paymentConfirmationModalLabel">
                            <i class="fas fa-credit-card me-2"></i>Konfirmasi Pembayaran
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-money-bill-wave text-success" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Konfirmasi Pembayaran</h5>
                        </div>
                        
                        <div class="alert alert-info">
                            <strong>Detail Booking:</strong><br>
                            ID: ${booking.id}<br>
                            Nama: ${booking.name}<br>
                            Kelas: ${booking.class}<br>
                            Harga: ${getClassPrice(booking.class)}
                        </div>
                        
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="paymentMethod" required>
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="cash">Cash/Tunai</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="e-wallet">E-Wallet (GoPay/OVO/DANA)</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="paymentAmount" class="form-label">Jumlah Pembayaran</label>
                            <input type="text" class="form-control" id="paymentAmount" value="${getClassPrice(booking.class)}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="paymentNotes" class="form-label">Catatan Pembayaran (Opsional)</label>
                            <textarea class="form-control" id="paymentNotes" rows="3" placeholder="Contoh: Transfer dari rekening BCA a.n. John Doe"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" onclick="confirmPayment('${booking.id}')">
                            <i class="fas fa-check me-2"></i>Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal
    const existingModal = document.getElementById('paymentConfirmationModal');
    if (existingModal) existingModal.remove();
    
    // Add and show modal
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    const modal = new bootstrap.Modal(document.getElementById('paymentConfirmationModal'));
    modal.show();
}

function confirmPayment(bookingId) {
    const paymentMethod = document.getElementById('paymentMethod').value;
    const paymentAmount = document.getElementById('paymentAmount').value;
    const paymentNotes = document.getElementById('paymentNotes').value;
    
    if (!paymentMethod) {
        showNotification('Pilih metode pembayaran', 'warning');
        return;
    }
    
    if (!paymentAmount) {
        showNotification('Masukkan jumlah pembayaran', 'warning');
        return;
    }
    
    try {
        const bookings = getAllBookings();
        const bookingIndex = bookings.findIndex(booking => booking.id === bookingId);
        
        if (bookingIndex === -1) {
            throw new Error('Booking not found');
        }
        
        // Update booking with payment info
        bookings[bookingIndex].paymentStatus = 'paid';
        bookings[bookingIndex].status = 'confirmed';
        bookings[bookingIndex].paymentMethod = paymentMethod;
        bookings[bookingIndex].paymentAmount = paymentAmount;
        bookings[bookingIndex].paymentNotes = paymentNotes;
        bookings[bookingIndex].paymentDate = new Date().toISOString();
        bookings[bookingIndex].lastUpdated = new Date().toISOString();
        
        // Save to localStorage
        saveToLocalStorage('bookings', bookings);
        updateBookingStats();
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('paymentConfirmationModal'));
        modal.hide();
        
        // Show success and refresh data
        showNotification(`Pembayaran booking ${bookingId} berhasil dikonfirmasi!`, 'success');
        
        // Refresh table if on admin page
        if (typeof loadBookingsData === 'function') {
            loadBookingsData();
        }
        
        return true;
    } catch (error) {
        console.error('Error confirming payment:', error);
        showNotification('Gagal mengkonfirmasi pembayaran', 'error');
        return false;
    }
}

function editBookingStatus(bookingId) {
    const booking = getBookingById(bookingId);
    if (!booking) {
        showNotification('Data booking tidak ditemukan', 'error');
        return;
    }
    
    const modalHTML = `
        <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="editStatusModalLabel">
                            <i class="fas fa-edit me-2"></i>Edit Status Booking
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <strong>Booking ID:</strong> ${booking.id}<br>
                            <strong>Nama:</strong> ${booking.name}<br>
                            <strong>Kelas:</strong> ${booking.class}
                        </div>
                        
                        <div class="mb-3">
                            <label for="newStatus" class="form-label">Status Baru</label>
                            <select class="form-select" id="newStatus" required>
                                <option value="pending" ${booking.status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="confirmed" ${booking.status === 'confirmed' ? 'selected' : ''}>Confirmed</option>
                                <option value="paid" ${booking.status === 'paid' ? 'selected' : ''}>Paid</option>
                                <option value="completed" ${booking.status === 'completed' ? 'selected' : ''}>Completed</option>
                                <option value="cancelled" ${booking.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="statusNotes" class="form-label">Catatan Perubahan (Opsional)</label>
                            <textarea class="form-control" id="statusNotes" rows="3" placeholder="Alasan perubahan status..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-warning" onclick="updateStatus('${booking.id}')">
                            <i class="fas fa-save me-2"></i>Update Status
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal
    const existingModal = document.getElementById('editStatusModal');
    if (existingModal) existingModal.remove();
    
    // Add and show modal
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    const modal = new bootstrap.Modal(document.getElementById('editStatusModal'));
    modal.show();
}

function updateStatus(bookingId) {
    const newStatus = document.getElementById('newStatus').value;
    const statusNotes = document.getElementById('statusNotes').value;
    
    if (!newStatus) {
        showNotification('Pilih status baru', 'warning');
        return;
    }
    
    const success = updateBookingStatus(bookingId, newStatus);
    
    if (success) {
        // If there are notes, save them
        if (statusNotes) {
            const bookings = getAllBookings();
            const bookingIndex = bookings.findIndex(booking => booking.id === bookingId);
            if (bookingIndex !== -1) {
                bookings[bookingIndex].statusNotes = statusNotes;
                saveToLocalStorage('bookings', bookings);
            }
        }
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('editStatusModal'));
        modal.hide();
        
        showNotification(`Status booking ${bookingId} berhasil diupdate ke ${getStatusText(newStatus)}!`, 'success');
        
        // Refresh table if on admin page
        if (typeof loadBookingsData === 'function') {
            loadBookingsData();
        }
    } else {
        showNotification('Gagal mengupdate status booking', 'error');
    }
}

function deleteBookingConfirmation(bookingId) {
    const booking = getBookingById(bookingId);
    if (!booking) {
        showNotification('Data booking tidak ditemukan', 'error');
        return;
    }
    
    if (confirm(`Apakah Anda yakin ingin menghapus booking ${bookingId} atas nama ${booking.name}?\n\nTindakan ini tidak dapat dibatalkan.`)) {
        const success = deleteBooking(bookingId);
        
        if (success) {
            showNotification(`Booking ${bookingId} berhasil dihapus!`, 'success');
            
            // Refresh table if on admin page
            if (typeof loadBookingsData === 'function') {
                loadBookingsData();
            }
        } else {
            showNotification('Gagal menghapus booking', 'error');
        }
    }
}

// ===== DYNAMIC GREETING =====
function getGreeting() {
    const hour = new Date().getHours();
    if (hour < 12) return 'Selamat Pagi';
    if (hour < 17) return 'Selamat Siang';
    if (hour < 19) return 'Selamat Sore';
    return 'Selamat Malam';
}

// ===== PARALLAX EFFECT =====
function initializeParallax() {
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.hero-section');
        
        parallaxElements.forEach(element => {
            const speed = 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

// ===== THEME FUNCTIONS =====
function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    document.documentElement.setAttribute('data-theme', newTheme);
    saveToLocalStorage('theme', newTheme);
    
    showNotification(`Tema berubah ke ${newTheme === 'dark' ? 'gelap' : 'terang'}`, 'success');
}

function loadSavedTheme() {
    const savedTheme = getFromLocalStorage('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-theme', savedTheme);
    }
}

// ===== INITIALIZE ON LOAD =====
window.addEventListener('load', function() {
    loadSavedTheme();
    initializeParallax();
    
    // Hide loading screen if exists
    const loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
        loadingScreen.style.opacity = '0';
        setTimeout(() => {
            loadingScreen.style.display = 'none';
        }, 500);
    }
    
    // Show welcome message
    setTimeout(() => {
        console.log(`${getGreeting()}! Selamat datang di Sanggar Tari Tatra KJD`);
    }, 1000);
});

// ===== ERROR HANDLING =====
window.addEventListener('error', function(e) {
    console.error('JavaScript Error:', e.error);
    showNotification('Terjadi kesalahan. Silakan refresh halaman.', 'error');
});

// ===== EXPORT FUNCTIONS (for use in other files) =====
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        showNotification,
        bookClass,
        validateEmail,
        validatePhone,
        formatPhoneNumber,
        showLoading,
        hideLoading
    };
}