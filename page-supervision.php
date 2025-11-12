<?php
/**
 * Template Name: Supervision Page
 *
 * This is the template that displays the Student Supervision page.
 * It contains: Supervision info, research areas, active projects, how to join, and requirements.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- PAGE TITLE & INTRODUCTION -->
        <!-- ============================================ -->
        <section style="padding: 10rem 5% 4rem; background: var(--white);">
            <h1 class="section-title fade-in">Student Supervision</h1>
            <p class="fade-in" style="text-align: center; max-width: 900px; margin: 0 auto; font-size: 1.2rem; color: var(--dark); line-height: 1.8;">
                Join CORES and contribute to cutting-edge coastal research while completing your undergraduate or graduate thesis under the guidance of our experienced faculty members.
            </p>
        </section>

        <!-- ============================================ -->
        <!-- ABOUT SUPERVISION -->
        <!-- ============================================ -->
        <section style="padding: 0 5% 6rem; background: var(--white);">
            <div class="fade-in" style="max-width: 1000px; margin: 0 auto;">
                <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 2rem; text-align: center;">Why Join CORES?</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-microscope"></i></div>
                        <h3>Hands-On Research</h3>
                        <p>Gain practical experience with state-of-the-art equipment including wave gauges, GNSS rovers, drones, and laboratory instruments.</p>
                    </div>
                    
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                        <h3>Expert Mentorship</h3>
                        <p>Work directly with experienced lecturers who are experts in coastal engineering, hydraulics, and numerical modeling.</p>
                    </div>
                    
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <h3>Field Experience</h3>
                        <p>Participate in coastal fieldwork at research sites like Clungup, collecting real-world data and samples.</p>
                    </div>
                    
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
                        <h3>Publication Opportunities</h3>
                        <p>Contribute to academic publications and present your research at conferences, building your academic portfolio.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH AREAS FOR STUDENTS -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in">Available Research Areas</h2>
            
            <div style="max-width: 1200px; margin: 0 auto;">
                <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark);">
                    Students can choose from a variety of research topics aligned with our core research areas:
                </p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                    <div class="publication fade-in">
                        <h4 style="color: var(--primary);"><i class="fas fa-water" style="color: var(--accent); margin-right: 0.5rem;"></i> Coastal Dynamics</h4>
                        <p style="font-size: 0.95rem;">Wave pattern analysis, tidal movements, erosion studies, and coastal process monitoring.</p>
                    </div>
                    
                    <div class="publication fade-in">
                        <h4 style="color: var(--primary);"><i class="fas fa-tree" style="color: var(--accent); margin-right: 0.5rem;"></i> Mangrove Ecosystems</h4>
                        <p style="font-size: 0.95rem;">Mangrove parameterization, carbon sequestration, ecosystem health assessment, and conservation strategies.</p>
                    </div>
                    
                    <div class="publication fade-in">
                        <h4 style="color: var(--primary);"><i class="fas fa-drone" style="color: var(--accent); margin-right: 0.5rem;"></i> Drone Topography</h4>
                        <p style="font-size: 0.95rem;">UAV-based coastal mapping, photogrammetry, terrain analysis, and contour generation using WebODM.</p>
                    </div>
                    
                    <div class="publication fade-in">
                        <h4 style="color: var(--primary);"><i class="fas fa-flask" style="color: var(--accent); margin-right: 0.5rem;"></i> Sediment Analysis</h4>
                        <p style="font-size: 0.95rem;">Laboratory sediment testing, composition analysis, transport modeling, and grain size distribution.</p>
                    </div>
                    
                    <div class="publication fade-in">
                        <h4 style="color: var(--primary);"><i class="fas fa-chart-line" style="color: var(--accent); margin-right: 0.5rem;"></i> Data Analysis</h4>
                        <p style="font-size: 0.95rem;">Statistical analysis, computational modeling, climate impact studies, and predictive modeling.</p>
                    </div>
                    
                    <div class="publication fade-in">
                        <h4 style="color: var(--primary);"><i class="fas fa-satellite" style="color: var(--accent); margin-right: 0.5rem;"></i> Remote Sensing</h4>
                        <p style="font-size: 0.95rem;">Satellite imagery analysis, change detection, large-scale coastal monitoring, and GIS applications.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- ACTIVE PROJECTS -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in">Current Student Projects</h2>
            
            <div class="timeline fade-in" style="max-width: 900px; margin: 0 auto;">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">In Progress</div>
                        <h4>Wave Gauge Data Analysis - Clungup Site</h4>
                        <p>Analyzing wave patterns and tidal data collected from four monitoring stations to understand seasonal variations and coastal dynamics.</p>
                        <span style="display: inline-block; padding: 0.3rem 0.8rem; background: var(--accent); color: white; border-radius: 15px; font-size: 0.85rem; margin-top: 0.5rem;">Data Analysis</span>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">In Progress</div>
                        <h4>Mangrove Carbon Sequestration Study</h4>
                        <p>Quantifying carbon storage in mangrove ecosystems using field measurements and remote sensing techniques for climate change mitigation assessment.</p>
                        <span style="display: inline-block; padding: 0.3rem 0.8rem; background: var(--accent); color: white; border-radius: 15px; font-size: 0.85rem; margin-top: 0.5rem;">Ecosystem Studies</span>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">In Progress</div>
                        <h4>Drone-Based Coastal Mapping</h4>
                        <p>Creating high-resolution topographic maps of coastal areas using photogrammetry techniques and WebODM software for erosion monitoring.</p>
                        <span style="display: inline-block; padding: 0.3rem 0.8rem; background: var(--accent); color: white; border-radius: 15px; font-size: 0.85rem; margin-top: 0.5rem;">Drone Topography</span>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">Available</div>
                        <h4>New Project Opportunities</h4>
                        <p>We are always looking for motivated students to join new research initiatives. Contact us to discuss available projects and thesis topics.</p>
                        <span style="display: inline-block; padding: 0.3rem 0.8rem; background: var(--primary); color: white; border-radius: 15px; font-size: 0.85rem; margin-top: 0.5rem;">Open</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- HOW TO JOIN -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in">How to Join CORES</h2>
            
            <div style="max-width: 1000px; margin: 0 auto;">
                <div class="stats-container" style="margin-bottom: 3rem;">
                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; margin-bottom: 1rem;"><i class="fas fa-file-alt" style="color: var(--accent);"></i></div>
                        <div class="stat-label" style="font-size: 1.1rem; font-weight: 600; color: var(--primary);">Step 1: Submit Application</div>
                        <p style="font-size: 0.9rem; margin-top: 0.5rem;">Send your CV and research interests via email</p>
                    </div>
                    
                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; margin-bottom: 1rem;"><i class="fas fa-comments" style="color: var(--accent);"></i></div>
                        <div class="stat-label" style="font-size: 1.1rem; font-weight: 600; color: var(--primary);">Step 2: Initial Meeting</div>
                        <p style="font-size: 0.9rem; margin-top: 0.5rem;">Discuss research interests and available projects</p>
                    </div>
                    
                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; margin-bottom: 1rem;"><i class="fas fa-clipboard-check" style="color: var(--accent);"></i></div>
                        <div class="stat-label" style="font-size: 1.1rem; font-weight: 600; color: var(--primary);">Step 3: Project Assignment</div>
                        <p style="font-size: 0.9rem; margin-top: 0.5rem;">Get matched with a supervisor and project</p>
                    </div>
                    
                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; margin-bottom: 1rem;"><i class="fas fa-rocket" style="color: var(--accent);"></i></div>
                        <div class="stat-label" style="font-size: 1.1rem; font-weight: 600; color: var(--primary);">Step 4: Start Research</div>
                        <p style="font-size: 0.9rem; margin-top: 0.5rem;">Begin your research journey with CORES</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- REQUIREMENTS -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in">What We Look For</h2>
            
            <div style="max-width: 900px; margin: 0 auto;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    <div class="fade-in">
                        <h3 style="color: var(--primary); margin-bottom: 1.5rem; font-size: 1.8rem;"><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i> Academic Requirements</h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 0.8rem 0; border-bottom: 1px solid var(--gray); font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> Currently enrolled in Water Resources Engineering or related program</li>
                            <li style="padding: 0.8rem 0; border-bottom: 1px solid var(--gray); font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> Minimum GPA of 3.0 (preferred)</li>
                            <li style="padding: 0.8rem 0; border-bottom: 1px solid var(--gray); font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> Strong foundation in mathematics and physics</li>
                            <li style="padding: 0.8rem 0; font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> Ability to commit to regular research activities</li>
                        </ul>
                    </div>
                    
                    <div class="fade-in">
                        <h3 style="color: var(--primary); margin-bottom: 1.5rem; font-size: 1.8rem;"><i class="fas fa-star" style="color: var(--accent); margin-right: 0.5rem;"></i> Desired Skills</h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 0.8rem 0; border-bottom: 1px solid var(--gray); font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> Enthusiasm for coastal science and fieldwork</li>
                            <li style="padding: 0.8rem 0; border-bottom: 1px solid var(--gray); font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> Basic programming skills (Python, MATLAB, or R)</li>
                            <li style="padding: 0.8rem 0; border-bottom: 1px solid var(--gray); font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> Experience with data analysis (preferred but not required)</li>
                            <li style="padding: 0.8rem 0; font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> Strong teamwork and communication skills</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- MEET OUR SUPERVISORS -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in">Meet Our Supervisors</h2>
            
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark);">
                Work with experienced faculty members who are passionate about mentoring the next generation of coastal researchers.
            </p>
            
            <div class="team-grid" style="max-width: 1000px; margin: 0 auto;">
                <div class="team-member fade-in">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Ir. Runi Asmaranto, ST., MT., IPM., ASEAN Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Dam Expert</span>
                        <span class="team-tag">Reservoir Conservation</span>
                    </div>
                </div>
                
                <div class="team-member fade-in">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Ir. Very Dermawan, ST., MT., IPM., ASEAN Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Hydraulics</span>
                    </div>
                </div>
                
                <div class="team-member fade-in">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Sebrian Mirdeklis Beselly Putra., ST., MT., M.Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Engineering</span>
                    </div>
                </div>
                
                <div class="team-member fade-in">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Muhammad Amar Sajali, ST., MT., M. Eng., Ph.D.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Numerical Modeling</span>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 3rem;">
                <a href="<?php echo esc_url( home_url( '/people/' ) ); ?>" class="cta-button">View Full Team</a>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CONTACT CTA -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: var(--primary); color: white; text-align: center;">
            <div class="fade-in" style="max-width: 800px; margin: 0 auto;">
                <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem; color: white;">Ready to Start Your Research Journey?</h2>
                <p style="font-size: 1.2rem; line-height: 1.8; margin-bottom: 2.5rem; opacity: 0.95;">
                    Join CORES and be part of groundbreaking coastal research. Contact us today to discuss available projects and supervision opportunities.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="#contact" class="cta-button" style="background: white; color: var(--primary); font-size: 1.1rem;">Send Us a Message</a>
                    <a href="mailto:<?php echo esc_attr( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?>" class="cta-button" style="background: var(--accent); font-size: 1.1rem;">Email Us Directly</a>
                </div>
            </div>
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>