<?php
/**
 * Template Name: Publications Page
 *
 * This is the template that displays the Publications page.
 * It contains: All research publications with metadata and links.
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
            <h1 class="section-title fade-in">Recent Publications</h1>
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto; font-size: 1.2rem; color: var(--dark); line-height: 1.8;">
                Explore our latest research findings and academic contributions to coastal science, published in peer-reviewed journals and conferences.
            </p>
        </section>

        <!-- ============================================ -->
        <!-- PUBLICATIONS LIST -->
        <!-- ============================================ -->
        <section class="publications-section" id="publications" style="padding: 0 5% 6rem; background: var(--white);">
            <div class="publication-list">
                
                <!-- Publication 1 -->
                <div class="publication fade-in">
                    <h4>Coastal Erosion Patterns in Southeast Asia: A Decade of Analysis</h4>
                    <p>Comprehensive analysis of erosion trends across Southeast Asian coastlines, revealing critical patterns and providing predictive models for future coastal management strategies.</p>
                    <div class="publication-meta">
                        <span><i class="fas fa-calendar-alt" style="color: var(--accent); margin-right: 0.5rem;"></i> 2023</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                
                <!-- Publication 2 -->
                <div class="publication fade-in">
                    <h4>Drone-Based Topographic Mapping of Mangrove Ecosystems</h4>
                    <p>Novel approaches to high-resolution mangrove ecosystem mapping using consumer-grade drones and open-source photogrammetry software for conservation monitoring.</p>
                    <div class="publication-meta">
                        <span><i class="fas fa-calendar-alt" style="color: var(--accent); margin-right: 0.5rem;"></i> 2023</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                
                <!-- Publication 3 -->
                <div class="publication fade-in">
                    <h4>Sediment Transport Modeling in Tropical Estuaries</h4>
                    <p>Development of improved computational models for predicting sediment transport patterns in tropical estuarine environments under climate change scenarios.</p>
                    <div class="publication-meta">
                        <span><i class="fas fa-calendar-alt" style="color: var(--accent); margin-right: 0.5rem;"></i> 2022</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                
                <!-- Publication 4 -->
                <div class="publication fade-in">
                    <h4>Wave Dynamics and Coastal Infrastructure Resilience</h4>
                    <p>Analysis of wave patterns and their impact on coastal infrastructure, with recommendations for improved design standards in vulnerable coastal regions.</p>
                    <div class="publication-meta">
                        <span><i class="fas fa-calendar-alt" style="color: var(--accent); margin-right: 0.5rem;"></i> 2022</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                
                <!-- Publication 5 -->
                <div class="publication fade-in">
                    <h4>Mangrove Carbon Sequestration: Measurement and Modeling</h4>
                    <p>Quantitative assessment of carbon storage in mangrove ecosystems using field measurements and remote sensing data for climate mitigation strategies.</p>
                    <div class="publication-meta">
                        <span><i class="fas fa-calendar-alt" style="color: var(--accent); margin-right: 0.5rem;"></i> 2022</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                
                <!-- Publication 6 -->
                <div class="publication fade-in">
                    <h4>Community-Based Coastal Adaptation Strategies</h4>
                    <p>Evaluation of community-led coastal adaptation initiatives and their effectiveness in building resilience to climate change impacts.</p>
                    <div class="publication-meta">
                        <span><i class="fas fa-calendar-alt" style="color: var(--accent); margin-right: 0.5rem;"></i> 2021</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                
            </div>
        </section>

        <!-- ============================================ -->
        <!-- PUBLICATION STATS (Optional) -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in">Our Research Impact</h2>
            
            <div class="stats-container">
                <div class="stat-card fade-in">
                    <div class="stat-number">6+</div>
                    <div class="stat-label">Published Papers</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Years Active</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">-</div>
                    <div class="stat-label">Citations</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">-</div>
                    <div class="stat-label">h-index</div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CALL TO ACTION -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: var(--white); text-align: center;">
            <div class="fade-in" style="max-width: 700px; margin: 0 auto;">
                <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1.5rem;">Looking for Collaboration?</h2>
                <p style="font-size: 1.2rem; color: var(--dark); line-height: 1.8; margin-bottom: 2rem;">
                    We welcome collaboration opportunities with researchers, institutions, and organizations interested in coastal science and marine conservation.
                </p>
                <a href="#contact" class="cta-button" style="font-size: 1.1rem;">Get In Touch</a>
            </div>
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>