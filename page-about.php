<?php
/**
 * Template Name: About Page
 *
 * This is the template that displays the About page.
 * It contains: Introduction, Research Focus, Equipment Showcase, and Impact Stats.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- ABOUT INTRODUCTION SECTION -->
        <!-- ============================================ -->
        <section class="about-intro-section" style="padding: 10rem 5% 4rem; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                <h1 class="section-title fade-in">About CORES</h1>
                
                <div class="about-intro-content fade-in" style="max-width: 900px; margin: 0 auto; text-align: center;">
                    <p style="font-size: 1.3rem; line-height: 1.8; color: var(--dark); margin-bottom: 2rem;">
                        We are <strong>Coastal Researchers (CORES)</strong>, a dedicated team of scientists and engineers committed to advancing our understanding of coastal ecosystems and processes. Based at the Water Resources Engineering Department of Brawijaya University, we combine cutting-edge technology with field expertise to address critical challenges facing our coastlines.
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: var(--dark); margin-bottom: 2rem;">
                        Our multidisciplinary approach integrates <strong>coastal dynamics monitoring</strong>, <strong>data analysis</strong>, <strong>remote sensing</strong>, and <strong>ecosystem studies</strong> to provide comprehensive insights into coastal behavior. Through innovative research methodologies and state-of-the-art equipment, we strive to develop sustainable solutions for coastal protection and management.
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: var(--dark);">
                        From drone-based topographic mapping to mangrove parameterization, from wave gauge deployment to sediment analysis, our research spans the full spectrum of coastal science. We believe that understanding these complex systems is essential for protecting our shorelines, communities, and marine ecosystems in an era of climate change and increasing coastal pressures.
                    </p>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH FOCUS SECTION -->
        <!-- ============================================ -->
        <section class="research-section" id="research-focus" style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in">Our Research Focus</h2>
            
            <div class="research-filters fade-in">
                <button class="filter-btn active" data-category="all" onclick="filterResearch('all')">All Research</button>
                <button class="filter-btn" data-category="monitoring" onclick="filterResearch('monitoring')">Coastal Monitoring</button>
                <button class="filter-btn" data-category="analysis" onclick="filterResearch('analysis')">Data Analysis</button>
                <button class="filter-btn" data-category="ecosystem" onclick="filterResearch('ecosystem')">Ecosystem Studies</button>
            </div>

            <div class="cards-container">
                <div class="card fade-in" data-category="monitoring">
                    <div class="card-icon"><i class="fas fa-water"></i></div>
                    <h3>Coastal Dynamics</h3>
                    <p>Advanced monitoring of wave patterns, tidal movements, and coastal processes using state-of-the-art equipment including wave gauges and GNSS rovers.</p>
                    <a href="#" class="card-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="analysis">
                    <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>Data Analysis</h3>
                    <p>Computational modeling and statistical analysis of coastal processes, climate change impacts, and erosion patterns using advanced software tools.</p>
                    <a href="#" class="card-link">View Projects <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="monitoring">
                    <div class="contour-icon">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <!-- Drone Body -->
                            <ellipse cx="50" cy="50" rx="12" ry="6" class="drone-body"/>
                            
                            <!-- Drone Arms -->
                            <line x1="38" y1="50" x2="25" y2="35" class="drone-arms"/>
                            <line x1="62" y1="50" x2="75" y2="35" class="drone-arms"/>
                            <line x1="38" y1="50" x2="25" y2="65" class="drone-arms"/>
                            <line x1="62" y1="50" x2="75" y2="65" class="drone-arms"/>
                            
                            <!-- Propellers -->
                            <circle cx="25" cy="35" r="6" class="drone-propellers"/>
                            <circle cx="75" cy="35" r="6" class="drone-propellers"/>
                            <circle cx="25" cy="65" r="6" class="drone-propellers"/>
                            <circle cx="75" cy="65" r="6" class="drone-propellers"/>
                            
                            <!-- Camera/Gimbal -->
                            <circle cx="50" cy="54" r="3" fill="#05BFDB"/>
                            <rect x="48" y="56" width="4" height="5" fill="#0A4D68"/>
                            
                            <!-- Topographic Contour Lines -->
                            <path d="M 15 80 Q 35 75, 50 80 T 85 80" class="topographic-lines"/>
                            <path d="M 15 85 Q 35 80, 50 85 T 85 85" class="topographic-lines"/>
                            <path d="M 15 90 Q 35 85, 50 90 T 85 90" class="topographic-lines"/>
                        </svg>
                    </div>
                    <h3>Drone Topography</h3>
                    <p>High-precision coastal mapping using drone photogrammetry with WebODM software for detailed terrain analysis and contour mapping.</p>
                    <a href="#" class="card-link">See Technology <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="ecosystem">
                    <div class="card-icon"><i class="fas fa-tree"></i></div>
                    <h3>Mangrove Studies</h3>
                    <p>Comprehensive mangrove ecosystem research including parameterization, carbon sequestration studies, and coastal protection analysis.</p>
                    <a href="#" class="card-link">Explore Research <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="analysis">
                    <div class="card-icon"><i class="fas fa-flask"></i></div>
                    <h3>Sediment Analysis</h3>
                    <p>Laboratory and field-based sediment composition analysis to understand coastal evolution and transport patterns.</p>
                    <a href="#" class="card-link">View Methods <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="monitoring">
                    <div class="card-icon"><i class="fas fa-satellite"></i></div>
                    <h3>Remote Sensing</h3>
                    <p>Satellite imagery and aerial photography analysis for large-scale coastal monitoring and change detection.</p>
                    <a href="#" class="card-link">Discover More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- EQUIPMENT SHOWCASE SECTION -->
        <!-- ============================================ -->
        <section class="equipment-section" style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in">Our Research Equipment</h2>
            
            <div class="equipment-showcase">
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('https://picsum.photos/seed/wavegauge/400/300.jpg');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name">Wave Gauge System</div>
                        <div class="equipment-desc">High-precision wave monitoring equipment for real-time coastal dynamics analysis</div>
                    </div>
                </div>
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('https://picsum.photos/seed/gnss/400/300.jpg');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name">GNSS Rover</div>
                        <div class="equipment-desc">Advanced positioning system for precise coastal topography measurements</div>
                    </div>
                </div>
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('https://picsum.photos/seed/drone/400/300.jpg');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name">Research Drone</div>
                        <div class="equipment-desc">UAV equipped with multispectral sensors for coastal ecosystem monitoring</div>
                    </div>
                </div>
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('https://picsum.photos/seed/sediment/400/300.jpg');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name">Sediment Sampler</div>
                        <div class="equipment-desc">Specialized equipment for collecting and analyzing coastal sediment samples</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- IMPACT STATS SECTION -->
        <!-- ============================================ -->
        <section class="impact-section" style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in">Our Impact</h2>
            
            <div class="stats-container">
                <div class="stat-card fade-in">
                    <div class="stat-number">-</div>
                    <div class="stat-label">Research Projects</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">-</div>
                    <div class="stat-label">Publications</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Team Members</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">1</div>
                    <div class="stat-label">Partner Institutions</div>
                </div>
            </div>
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>