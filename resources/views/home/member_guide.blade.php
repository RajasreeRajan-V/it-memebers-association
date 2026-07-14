@extends('layouts.app')

@section('content')

<!-- Contact Hero with Role-Based CTAs -->
<section class="hero" id="contact">
    <div class="container hero-inner">
        <div class="hero-copy">
            <p class="eyebrow">Connect With Us</p>
            <h1>
                Join Our <span class="accent-text">Professional Community</span>
            </h1>
            <p class="hero-sub">
                Whether you're a student, employee, employer, freelancer, investor, or mentor — 
                we're here to support your journey. Choose your role below to get the right assistance.
            </p>
        </div>

        <div class="hero-membership">
            <div class="membership-card">
                <span class="membership-glow"></span>
                <div class="membership-badge">
                    <svg viewBox="0 0 24 24" width="28" height="28">
                        <path d="M12 2l2.4 7.2H22l-6 4.6 2.3 7.2-6.3-4.6-6.3 4.6 2.3-7.2-6-4.6h7.6z"
                              stroke="white" stroke-width="1.5" fill="rgba(255,255,255,0.15)"/>
                    </svg>
                </div>
                <h3>Unlock Full Access</h3>
                <p>Join as a member and get verified opportunities, mentorship, and tools built for your role.</p>
                <a href="{{ route('registration') }}" class="btn btn-membership">
                    <span>Take Membership</span>
                    <svg viewBox="0 0 24 24" width="16" height="16">
                        <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </a>
                <p class="membership-note">Plans starting at just ₹500/year</p>
            </div>
        </div>
    </div>
</section>


<!-- Support Categories -->
<section class="portals">
    <div class="container">
        <div class="section-head">
            <h2>How Can We Help You?</h2>
            <p>Select your role to get started with the right support channel.</p>
        </div>

        <!-- Student Support -->
        <div id="student-support" class="role-support-section">
            <div class="role-header">
                <svg class="role-header-icon" viewBox="0 0 24 24" width="32" height="32">
                    <path d="M12 3L1 9l11 6 11-6-11-6z" stroke="#4A90D9" stroke-width="2" fill="#4A90D9" opacity="0.2"/>
                    <path d="M1 9l11 6 11-6" stroke="#4A90D9" stroke-width="2" fill="none"/>
                    <path d="M1 9v6" stroke="#4A90D9" stroke-width="2" fill="none"/>
                    <path d="M12 15v6" stroke="#4A90D9" stroke-width="2" fill="none"/>
                    <path d="M23 9v6" stroke="#4A90D9" stroke-width="2" fill="none"/>
                </svg>
                <h3>Student Support</h3>
                <p>Need help with job applications, course enrollments, or mentorship?</p>
            </div>
            
            <!-- Student Benefits -->
            <div class="benefits-section">
                <h4>
                    <svg class="section-icon" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 17l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                    Key Benefits for Students
                </h4>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#4A90D9" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Career Launchpad</strong>
                            <p>Access to 500+ internships and entry-level jobs with verified employers</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#4A90D9" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Skill Development</strong>
                            <p>Free access to 50+ courses, training programs, and hackathons</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#4A90D9" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Mentorship Network</strong>
                            <p>1-on-1 guidance from industry experts and experienced professionals</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#4A90D9" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Resume Building</strong>
                            <p>Professional resume review and feedback from certified mentors</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#4A90D9" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Networking Events</strong>
                            <p>Exclusive access to webinars, workshops, and industry networking events</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#4A90D9" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Affordable Membership</strong>
                            <p>Just ₹500/year - includes all premium features and resources</p>
                        </div>
                    </div>
                </div>
            </div>

            
            
            <!-- Student Workflow -->
            <div class="workflow-info">
                <details>
                    <summary>
                        <svg class="summary-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M16 13H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 17H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 9h4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        View Student Journey
                    </summary>
                    <div class="workflow-steps">
                        <div class="step">1. Register & Pay ₹500</div>
                        <div class="step">2. Admin Verification (College ID)</div>
                        <div class="step">3. Access Dashboard</div>
                        <div class="step">4. Apply for Jobs/Internships</div>
                        <div class="step">5. Enroll in Courses & Training</div>
                        <div class="step">6. Request Resume Review</div>
                        <div class="step">7. Attend Events & Webinars</div>
                        <div class="step">8. Get Mentorship & Career Guidance</div>
                    </div>
                </details>
            </div>
        </div>

        <!-- Employee Support -->
        <div id="employee-support" class="role-support-section">
            <div class="role-header">
                <svg class="role-header-icon" viewBox="0 0 24 24" width="32" height="32">
                    <rect x="2" y="7" width="20" height="14" rx="2" stroke="#2ECC71" stroke-width="2" fill="#2ECC71" opacity="0.2"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" stroke="#2ECC71" stroke-width="2" fill="none"/>
                </svg>
                <h3>Employee Support</h3>
                <p>Assistance with job switches, side projects, and professional development.</p>
            </div>
            
            <!-- Employee Benefits -->
            <div class="benefits-section">
                <h4>
                    <svg class="section-icon" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 17l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                    Key Benefits for Employees
                </h4>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#2ECC71" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Career Advancement</strong>
                            <p>Access to 1000+ premium job opportunities for career switches</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#2ECC71" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Side Projects</strong>
                            <p>Earn extra income through freelance projects and consulting work</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#2ECC71" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Knowledge Sharing</strong>
                            <p>Publish technical articles and build your professional brand</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#2ECC71" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Legal Support</strong>
                            <p>Professional legal assistance for workplace issues and contracts</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#2ECC71" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Continuous Learning</strong>
                            <p>Access to advanced training, workshops, and certification programs</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#2ECC71" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Premium Membership</strong>
                            <p>₹1000/year - includes all career development resources</p>
                        </div>
                    </div>
                </div>
            </div>

            
            
            <!-- Employee Workflow -->
            <div class="workflow-info">
                <details>
                    <summary>
                        <svg class="summary-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M16 13H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 17H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 9h4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        View Employee Journey
                    </summary>
                    <div class="workflow-steps">
                        <div class="step">1. Register & Pay ₹1000</div>
                        <div class="step">2. Admin Verification (Experience Proof)</div>
                        <div class="step">3. Access Employee Dashboard</div>
                        <div class="step">4. Apply for Job Switches</div>
                        <div class="step">5. Explore Side Projects</div>
                        <div class="step">6. Publish Technical Articles</div>
                        <div class="step">7. Request Legal Help</div>
                        <div class="step">8. Attend Training Programs</div>
                    </div>
                </details>
            </div>
        </div>

        <!-- Employer Support -->
        <div id="employer-support" class="role-support-section">
            <div class="role-header">
                <svg class="role-header-icon" viewBox="0 0 24 24" width="32" height="32">
                    <rect x="2" y="7" width="20" height="14" rx="2" stroke="#F39C12" stroke-width="2" fill="#F39C12" opacity="0.2"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" stroke="#F39C12" stroke-width="2" fill="none"/>
                    <path d="M8 12h8" stroke="#F39C12" stroke-width="2"/>
                    <path d="M8 16h6" stroke="#F39C12" stroke-width="2"/>
                </svg>
                <h3>Employer Support</h3>
                <p>Help with job postings, candidate management, and talent acquisition.</p>
            </div>
            
            <!-- Employer Benefits -->
            <div class="benefits-section">
                <h4>
                    <svg class="section-icon" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 17l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                    Key Benefits for Employers
                </h4>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#F39C12" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Talent Pool Access</strong>
                            <p>Connect with 10,000+ verified professionals across all experience levels</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#F39C12" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Zero Cost Hiring</strong>
                            <p>Post unlimited jobs and internships with no placement fees</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#F39C12" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Outsourcing Solutions</strong>
                            <p>Access to 200+ verified freelancers for project outsourcing</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#F39C12" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Investment Opportunities</strong>
                            <p>Connect with 50+ investors through startup profiles and pitch nights</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#F39C12" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Brand Visibility</strong>
                            <p>Showcase your company to 15,000+ community members</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#F39C12" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Business Membership</strong>
                            <p>₹5000/year - complete recruitment and branding suite</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- Employer Workflow -->
            <div class="workflow-info">
                <details>
                    <summary>
                        <svg class="summary-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M16 13H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 17H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 9h4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        View Employer Journey
                    </summary>
                    <div class="workflow-steps">
                        <div class="step">1. Register & Pay ₹5000</div>
                        <div class="step">2. Admin Verification (GST/PAN)</div>
                        <div class="step">3. Access Employer Dashboard</div>
                        <div class="step">4. Post Jobs/Internships/Projects</div>
                        <div class="step">5. Review Applications & Bids</div>
                        <div class="step">6. Hire Talent & Freelancers</div>
                        <div class="step">7. Post Startup Profile (Optional)</div>
                        <div class="step">8. Connect with Investors</div>
                    </div>
                </details>
            </div>
        </div>

        <!-- Freelancer Support -->
        <div id="freelancer-support" class="role-support-section">
            <div class="role-header">
                <svg class="role-header-icon" viewBox="0 0 24 24" width="32" height="32">
                    <rect x="4" y="4" width="16" height="16" rx="2" stroke="#9B59B6" stroke-width="2" fill="#9B59B6" opacity="0.2"/>
                    <path d="M9 8h6" stroke="#9B59B6" stroke-width="2"/>
                    <path d="M9 12h4" stroke="#9B59B6" stroke-width="2"/>
                    <path d="M9 16h6" stroke="#9B59B6" stroke-width="2"/>
                </svg>
                <h3>Freelancer Support</h3>
                <p>Assistance with projects, bids, payments, and portfolio management.</p>
            </div>
            
            <!-- Freelancer Benefits -->
            <div class="benefits-section">
                <h4>
                    <svg class="section-icon" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 17l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                    Key Benefits for Freelancers
                </h4>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#9B59B6" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Project Access</strong>
                            <p>Bid on 100+ premium projects from verified employers</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#9B59B6" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Secure Payments</strong>
                            <p>Escrow protection and guaranteed payment release on completion</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#9B59B6" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Portfolio Showcase</strong>
                            <p>Showcase your work to 200+ potential clients</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#9B59B6" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Service Promotion</strong>
                            <p>List your services and get discovered by businesses</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#9B59B6" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Community Support</strong>
                            <p>Network with other freelancers and share best practices</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#9B59B6" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Professional Membership</strong>
                            <p>₹1500/year - includes premium project access and features</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Freelancer Workflow -->
            <div class="workflow-info">
                <details>
                    <summary>
                        <svg class="summary-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M16 13H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 17H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 9h4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        View Freelancer Journey
                    </summary>
                    <div class="workflow-steps">
                        <div class="step">1. Register & Pay ₹1500</div>
                        <div class="step">2. Admin Verification (Portfolio)</div>
                        <div class="step">3. Access Freelancer Dashboard</div>
                        <div class="step">4. View & Bid on Projects</div>
                        <div class="step">5. Post Services</div>
                        <div class="step">6. Upload Portfolio Pieces</div>
                        <div class="step">7. Work & Request Payment</div>
                        <div class="step">8. Get Paid & Build Reputation</div>
                    </div>
                </details>
            </div>
        </div>

        <!-- Investor Support -->
        <div id="investor-support" class="role-support-section">
            <div class="role-header">
                <svg class="role-header-icon" viewBox="0 0 24 24" width="32" height="32">
                    <path d="M12 2v4" stroke="#E74C3C" stroke-width="2"/>
                    <path d="M12 18v4" stroke="#E74C3C" stroke-width="2"/>
                    <path d="M4 12H2" stroke="#E74C3C" stroke-width="2"/>
                    <path d="M22 12h-2" stroke="#E74C3C" stroke-width="2"/>
                    <circle cx="12" cy="12" r="3" stroke="#E74C3C" stroke-width="2" fill="#E74C3C" opacity="0.2"/>
                </svg>
                <h3>Investor Support</h3>
                <p>Help with startup discovery, pitch deck access, and founder connections.</p>
            </div>
            
            <!-- Investor Benefits -->
            <div class="benefits-section">
                <h4>
                    <svg class="section-icon" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 17l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                    Key Benefits for Investors
                </h4>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#E74C3C" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Exclusive Access</strong>
                            <p>View 50+ vetted startup profiles and investment opportunities</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#E74C3C" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Pitch Deck Access</strong>
                            <p>Request and receive full pitch decks from promising startups</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#E74C3C" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Direct Connections</strong>
                            <p>Connect directly with founders for investment discussions</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#E74C3C" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Pitch Nights</strong>
                            <p>Attend exclusive pitch events and meet top founders</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#E74C3C" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Deal Flow</strong>
                            <p>Receive curated investment opportunities matching your criteria</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#E74C3C" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Premium Membership</strong>
                            <p>₹10,000/year - complete investment discovery and networking suite</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Investor Workflow -->
            <div class="workflow-info">
                <details>
                    <summary>
                        <svg class="summary-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M16 13H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 17H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 9h4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        View Investor Journey
                    </summary>
                    <div class="workflow-steps">
                        <div class="step">1. Register & Pay ₹10,000</div>
                        <div class="step">2. Admin Verification (Credentials)</div>
                        <div class="step">3. Access Investor Dashboard</div>
                        <div class="step">4. View Startup Profiles</div>
                        <div class="step">5. Request Pitch Deck Access</div>
                        <div class="step">6. Connect with Founders</div>
                        <div class="step">7. Express Investment Interest</div>
                        <div class="step">8. Attend Pitch Nights & Deal Closure</div>
                    </div>
                </details>
            </div>
        </div>

        <!-- Mentor Support -->
        <div id="mentor-support" class="role-support-section">
            <div class="role-header">
                <svg class="role-header-icon" viewBox="0 0 24 24" width="32" height="32">
                    <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z" stroke="#3498DB" stroke-width="2" fill="#3498DB" opacity="0.2"/>
                    <path d="M12 6v6l4 2" stroke="#3498DB" stroke-width="2"/>
                </svg>
                <h3>Mentor Support</h3>
                <p>Assistance with mentorship sessions, webinars, and content creation.</p>
            </div>
            
            <!-- Mentor Benefits -->
            <div class="benefits-section">
                <h4>
                    <svg class="section-icon" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 17l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                    Key Benefits for Mentors
                </h4>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#3498DB" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Free Membership</strong>
                            <p>₹0 registration - full access to all mentor features</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#3498DB" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Impact & Recognition</strong>
                            <p>Guide the next generation of professionals and get recognized</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#3498DB" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Thought Leadership</strong>
                            <p>Host webinars, workshops, and share your expertise</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#3498DB" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Network Growth</strong>
                            <p>Connect with other mentors, industry leaders, and professionals</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#3498DB" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Flexible Commitment</strong>
                            <p>Choose your availability and mentoring style</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <svg class="benefit-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M20 6L9 17l-5-5" stroke="#3498DB" stroke-width="2" fill="none"/>
                        </svg>
                        <div>
                            <strong>Giving Back</strong>
                            <p>Make a meaningful difference in someone's career journey</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mentor Workflow -->
            <div class="workflow-info">
                <details>
                    <summary>
                        <svg class="summary-icon" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M16 13H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 17H8" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 9h4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        View Mentor Journey
                    </summary>
                    <div class="workflow-steps">
                        <div class="step">1. Register for FREE</div>
                        <div class="step">2. Admin Verification (Experience)</div>
                        <div class="step">3. Access Mentor Dashboard</div>
                        <div class="step">4. View Mentorship Requests</div>
                        <div class="step">5. Accept Mentees & Review Resumes</div>
                        <div class="step">6. Host Webinars & Workshops</div>
                        <div class="step">7. Upload Training Materials</div>
                        <div class="step">8. Conduct Mock Interviews & Give Feedback</div>
                    </div>
                </details>
            </div>
        </div>

        <!-- Role Upgrade Information -->
        <div class="role-upgrade-section">
            <h3>
                <svg class="section-icon" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M4 4h16v16H4V4z" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M4 6l8 7 8-7" stroke="currentColor" stroke-width="2"/>
                    <path d="M4 12l8 7 8-7" stroke="currentColor" stroke-width="2"/>
                </svg>
                Upgrade Your Membership
            </h3>
            <p>As your career grows, upgrade your role to access more features and opportunities.</p>
            <div class="upgrade-grid">
                <div class="upgrade-card">
                    <h4>Student → Employee</h4>
                    <p>Current: ₹500 | Upgrade: +₹500</p>
                    <ul>
                        <li>Access to job switch opportunities</li>
                        <li>Side project listings</li>
                        <li>Legal help support</li>
                    </ul>
                    <button class="btn btn-primary" onclick="alert('Upgrade process initiated. Pay difference ₹500.')">Upgrade Now</button>
                </div>
                <div class="upgrade-card">
                    <h4>Employee → Freelancer</h4>
                    <p>Current: ₹1000 | Upgrade: +₹500</p>
                    <ul>
                        <li>Bid on projects</li>
                        <li>Post services</li>
                        <li>Portfolio showcase</li>
                    </ul>
                    <button class="btn btn-primary" onclick="alert('Upgrade process initiated. Pay difference ₹500.')">Upgrade Now</button>
                </div>
                <div class="upgrade-card">
                    <h4>Student → Freelancer</h4>
                    <p>Current: ₹500 | Upgrade: +₹1000</p>
                    <ul>
                        <li>Access to projects</li>
                        <li>Service posting</li>
                        <li>Payment protection</li>
                    </ul>
                    <button class="btn btn-primary" onclick="alert('Upgrade process initiated. Pay difference ₹1000.')">Upgrade Now</button>
                </div>
                <div class="upgrade-card">
                    <h4>Student → Investor</h4>
                    <p>Current: ₹500 | Upgrade: +₹9500</p>
                    <ul>
                        <li>Startup profiles access</li>
                        <li>Pitch deck viewing</li>
                        <li>Founder connections</li>
                    </ul>
                    <button class="btn btn-primary" onclick="alert('Upgrade process initiated. Pay difference ₹9500.')">Upgrade Now</button>
                </div>
            </div>
        </div>

        <!-- Admin Contact for Urgent Issues -->
        <!-- <div class="admin-contact">
            <div class="admin-contact-inner">
                <svg class="admin-icon" viewBox="0 0 24 24" width="48" height="48">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="white" stroke-width="2" fill="none"/>
                    <path d="M2 17l10 5 10-5" stroke="white" stroke-width="2" fill="none"/>
                    <path d="M2 12l10 5 10-5" stroke="white" stroke-width="2" fill="none"/>
                </svg>
                <h3>Urgent Admin Support</h3>
                <p>For verification issues, payment disputes, or urgent approval matters</p>
                <div class="admin-contact-options">
                    <a href="mailto:admin@skillconnect.com" class="btn btn-primary">Email Admin</a>
                    <a href="#" class="btn btn-secondary" onclick="openEscalation()">Escalate Issue</a>
                </div>
            </div>
        </div> -->

        <!-- Status Tracking -->
        <!-- <div class="status-tracking">
            <h3>
                <svg class="section-icon" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M14 2v6h6" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M12 18v-4" stroke="currentColor" stroke-width="2"/>
                    <path d="M12 9v.01" stroke="currentColor" stroke-width="2"/>
                </svg>
                Track Your Request Status
            </h3>
            <p>Enter your application/reference ID to check status</p>
            <div class="status-form">
                <input type="text" placeholder="Enter Application ID (e.g., APP-2026-001)" class="status-input">
                <button class="btn btn-primary" onclick="trackStatus()">Track Status</button>
            </div>
        </div>
    </div> -->
</section>

<!-- Quick Support Modal -->
<div id="supportModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalBody">
            <h2>Quick Support Chat</h2>
            <p>Select your issue type:</p>
            <div class="quick-issues">
                <button class="issue-btn" onclick="startChat('application')">Application Status</button>
                <button class="issue-btn" onclick="startChat('payment')">Payment Issue</button>
                <button class="issue-btn" onclick="startChat('verification')">Verification Help</button>
                <button class="issue-btn" onclick="startChat('technical')">Technical Issue</button>
                <button class="issue-btn" onclick="startChat('other')">Other</button>
            </div>
            <div id="chatArea">
                <textarea placeholder="Describe your issue..." rows="4"></textarea>
                <button class="btn btn-primary" onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>
</div>

<style>
    .hero-inner {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    align-items: center;
    gap: 50px;
}

.hero-membership {
    display: flex;
    justify-content: center;
}

.membership-card {
    position: relative;
    width: 100%;
    max-width: 340px;
    padding: 36px 28px;
    border-radius: 24px;
    text-align: center;
    color: white;
    background: linear-gradient(135deg, var(--accent-color, #4A90D9), var(--primary-color, #2d3748));
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    overflow: hidden;
    animation: floatCard 4s ease-in-out infinite;
}

.membership-glow {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.25) 0%, transparent 60%);
    animation: rotateGlow 8s linear infinite;
    pointer-events: none;
}

.membership-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    margin-bottom: 18px;
    animation: pulseBadge 2.2s ease-in-out infinite;
}

.membership-card h3 {
    position: relative;
    margin: 0 0 10px 0;
    font-size: 22px;
}

.membership-card p {
    position: relative;
    margin: 0 0 22px 0;
    opacity: 0.9;
    font-size: 14px;
    line-height: 1.5;
}

.btn-membership {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 26px;
    background: white;
    color: var(--primary-color, #2d3748);
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.btn-membership svg {
    transition: transform 0.25s ease;
}

.btn-membership:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.btn-membership:hover svg {
    transform: translateX(4px);
}

.membership-note {
    position: relative;
    margin-top: 16px !important;
    font-size: 12px !important;
    opacity: 0.75;
}

@keyframes floatCard {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes rotateGlow {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulseBadge {
    0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.4); }
    50% { box-shadow: 0 0 0 12px rgba(255,255,255,0); }
}

@media (max-width: 768px) {
    .hero-inner {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .membership-card {
        max-width: 100%;
    }
}
/* Role Badges */
.role-quick-links {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 30px;
    justify-content: center;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding: 10px 20px;
    border-radius: 50px;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    font-weight: 500;
}

.role-badge .role-icon {
    flex-shrink: 0;
}

.role-badge:hover {
    background: var(--accent-color);
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

/* Role Support Sections */
.role-support-section {
    margin-bottom: 50px;
    padding: 30px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.role-header {
    display: flex;
    flex-direction: column;
    margin-bottom: 25px;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 15px;
}

.role-header .role-header-icon {
    margin-bottom: 10px;
}

.role-header h3 {
    margin: 0 0 5px 0;
    font-size: 24px;
}

.role-header p {
    color: #6c757d;
    margin: 0;
}

/* Benefits Section */
.benefits-section {
    background: linear-gradient(135deg, #f0f4ff 0%, #e8edf5 100%);
    padding: 20px 25px;
    border-radius: 12px;
    margin-bottom: 25px;
}

.benefits-section h4 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 0 15px 0;
    color: #2d3748;
    font-size: 18px;
}

.benefits-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.benefit-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 8px 12px;
    background: rgba(255,255,255,0.7);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.benefit-item:hover {
    background: white;
    transform: translateX(5px);
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.benefit-icon {
    flex-shrink: 0;
    margin-top: 2px;
}

.benefit-item strong {
    display: block;
    font-size: 14px;
    color: #2d3748;
}

.benefit-item p {
    margin: 0;
    font-size: 13px;
    color: #4a5568;
}

/* Workflow Info */
.workflow-info {
    margin-top: 20px;
    padding: 15px 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.workflow-info details {
    cursor: pointer;
}

.workflow-info summary {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #2d3748;
    padding: 5px 0;
}

.summary-icon {
    flex-shrink: 0;
}

.workflow-steps {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    padding: 15px 0 5px;
}

.workflow-steps .step {
    padding: 6px 12px;
    background: white;
    border-radius: 6px;
    border-left: 3px solid var(--accent-color);
    font-size: 14px;
    color: #4a5568;
}

/* Upgrade Section */
.role-upgrade-section {
    margin: 40px 0;
    padding: 30px;
    background: linear-gradient(135deg, #b2c0d3 0%, #5591D1 100%);
    border-radius: 20px;
}

.role-upgrade-section h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 0 10px 0;
    color: #2d3748;
}

.role-upgrade-section > p {
    color: #4a5568;
    margin-bottom: 20px;
}

.upgrade-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.upgrade-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.upgrade-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.upgrade-card h4 {
    margin: 0 0 5px 0;
    color: #2d3748;
}

.upgrade-card p {
    margin: 0 0 10px 0;
    color: #6c757d;
    font-weight: 500;
}

.upgrade-card ul {
    list-style: none;
    padding: 0;
    margin: 0 0 15px 0;
}

.upgrade-card ul li {
    padding: 3px 0;
    font-size: 14px;
    color: #4a5568;
}

.upgrade-card ul li::before {
    content: "✓ ";
    color: var(--accent-color);
    font-weight: 600;
}

.support-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.support-card {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.support-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.support-card h4 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    color: var(--primary-color);
}

.support-card .card-icon {
    flex-shrink: 0;
}

.support-card ul {
    list-style: none;
    padding: 0;
    margin-bottom: 15px;
}

.support-card ul li {
    padding: 5px 0;
    padding-left: 5px;
    border-bottom: 1px solid #e9ecef;
    color: #495057;
}

.support-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--accent-color);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.support-link .link-icon {
    flex-shrink: 0;
}

.support-link:hover {
    color: var(--primary-color);
}

/* General Contact */
.general-contact {
    margin: 40px 0;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
}

.general-contact h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.contact-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.contact-item .contact-icon {
    flex-shrink: 0;
    color: var(--accent-color);
}

.contact-item h4 {
    margin: 0 0 3px 0;
    font-size: 16px;
    color: #2d3748;
}

.contact-item p {
    margin: 0;
    color: #4a5568;
    font-weight: 500;
}

.contact-item small {
    color: #6c757d;
    display: block;
    margin-top: 5px;
    font-size: 13px;
}

/* Admin Contact */
.admin-contact {
    margin: 40px 0;
    padding: 30px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border-radius: 20px;
    color: white;
}

.admin-contact-inner {
    text-align: center;
}

.admin-icon {
    margin-bottom: 15px;
}

.admin-contact-inner h3 {
    margin: 0 0 10px 0;
    font-size: 28px;
}

.admin-contact-inner p {
    margin: 0 0 20px 0;
    opacity: 0.9;
}

.admin-contact-options {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 20px;
}

.admin-contact-options .btn-secondary {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 1px solid rgba(255,255,255,0.3);
}

.admin-contact-options .btn-secondary:hover {
    background: rgba(255,255,255,0.3);
}

/* Status Tracking */
.status-tracking {
    margin: 40px 0;
    padding: 30px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    text-align: center;
}

.status-tracking h3 {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.status-tracking p {
    color: #6c757d;
    margin-bottom: 20px;
}

.status-form {
    display: flex;
    gap: 15px;
    max-width: 500px;
    margin: 20px auto 0;
}

.status-input {
    flex: 1;
    padding: 12px 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.status-input:focus {
    border-color: var(--accent-color);
    outline: none;
}

/* Modal Styles */
.modal {
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    padding: 30px;
    border-radius: 20px;
    max-width: 500px;
    width: 90%;
    position: relative;
}

.close {
    position: absolute;
    right: 20px;
    top: 15px;
    font-size: 28px;
    cursor: pointer;
    color: #6c757d;
    transition: color 0.3s ease;
}

.close:hover {
    color: #dc3545;
}

.quick-issues {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 20px 0;
}

.issue-btn {
    padding: 8px 16px;
    border: 2px solid #e9ecef;
    border-radius: 20px;
    background: white;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.issue-btn:hover {
    border-color: var(--accent-color);
    background: var(--accent-color);
    color: white;
}

#chatArea {
    margin-top: 20px;
}

#chatArea textarea {
    width: 100%;
    padding: 10px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-family: inherit;
    font-size: 14px;
    transition: border-color 0.3s ease;
    resize: vertical;
}

#chatArea textarea:focus {
    border-color: var(--accent-color);
    outline: none;
}

.section-icon {
    flex-shrink: 0;
    color: var(--accent-color);
}

/* Responsive */
@media (max-width: 768px) {
    .support-grid {
        grid-template-columns: 1fr;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
    
    .workflow-steps {
        grid-template-columns: 1fr;
    }
    
    .status-form {
        flex-direction: column;
    }
    
    .admin-contact-options {
        flex-direction: column;
        align-items: center;
    }
    
    .role-quick-links {
        gap: 8px;
    }
    
    .role-badge {
        padding: 8px 15px;
        font-size: 14px;
    }
    
    .contact-info-grid {
        grid-template-columns: 1fr;
    }
    
    .role-header h3 {
        font-size: 20px;
    }
    
    .upgrade-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .role-badge {
        font-size: 12px;
        padding: 6px 12px;
    }
    
    .role-badge .role-icon {
        width: 16px;
        height: 16px;
    }
    
    .support-card {
        padding: 15px;
    }
    
    .modal-content {
        padding: 20px;
    }
}
</style>

<script>
// Quick support chat
function openSupportChat(role) {
    const modal = document.getElementById('supportModal');
    modal.style.display = 'flex';
    document.getElementById('modalBody').innerHTML = `
        <h2>${getRoleIcon(role)} ${capitalize(role)} Support</h2>
        <p>How can we help you today?</p>
        <div class="quick-issues">
            <button class="issue-btn" onclick="startChat('application')">Application Status</button>
            <button class="issue-btn" onclick="startChat('payment')">Payment Issue</button>
            <button class="issue-btn" onclick="startChat('verification')">Verification Help</button>
            <button class="issue-btn" onclick="startChat('technical')">Technical Issue</button>
            <button class="issue-btn" onclick="startChat('other')">Other</button>
        </div>
        <div id="chatArea">
            <textarea placeholder="Describe your issue..." rows="4"></textarea>
            <button class="btn btn-primary" onclick="sendMessage()">Send</button>
        </div>
    `;
}

function getRoleIcon(role) {
    const icons = {
        student: '🎓',
        employee: '💼',
        employer: '🏢',
        freelancer: '💻',
        investor: '💰',
        mentor: '🧠'
    };
    return icons[role] || '📞';
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function closeModal() {
    document.getElementById('supportModal').style.display = 'none';
}

function startChat(type) {
    const chatArea = document.getElementById('chatArea');
    const types = {
        application: 'I need help with my application status. My ID is: ',
        payment: 'I have a payment issue. My transaction ID is: ',
        verification: 'I need help with verification. My details are: ',
        technical: 'I\'m facing a technical issue: ',
        other: 'I need help with: '
    };
    chatArea.innerHTML = `
        <textarea placeholder="${types[type]}" rows="4"></textarea>
        <button class="btn btn-primary" onclick="sendMessage()">Send</button>
    `;
}

function sendMessage() {
    const textarea = document.querySelector('#chatArea textarea');
    if (textarea && textarea.value.trim()) {
        alert('✅ Your message has been sent! Our team will respond within 24 hours.');
        closeModal();
    } else {
        alert('Please enter your message.');
    }
}

function trackStatus() {
    const input = document.querySelector('.status-input');
    if (input && input.value.trim()) {
        alert(`🔍 Checking status for: ${input.value}\n\nStatus: Under Review\nLast Updated: ${new Date().toLocaleDateString()}\n\nOur team is processing your request. You'll receive an update within 48 hours.`);
    } else {
        alert('Please enter your Application ID to track status.');
    }
}

function openEscalation() {
    const modal = document.getElementById('supportModal');
    modal.style.display = 'flex';
    document.getElementById('modalBody').innerHTML = `
        <h2>🚨 Urgent Escalation</h2>
        <p>This will be sent directly to the Admin team.</p>
        <div id="chatArea">
            <textarea placeholder="Describe your urgent issue..." rows="4"></textarea>
            <button class="btn btn-primary" onclick="sendMessage()">Escalate Now</button>
        </div>
    `;
}

// Close modal on click outside
window.onclick = function(event) {
    const modal = document.getElementById('supportModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>

@endsection