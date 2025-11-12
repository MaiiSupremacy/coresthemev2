<?php
/**
 * Template Name: People Page
 *
 * This is the template that displays the People/Team page.
 * It contains: Team filters, Lecturers, Researchers, and Team Modals.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- TEAM SECTION -->
        <!-- ============================================ -->
        <section class="team-section" id="team" style="padding: 10rem 5% 6rem; background: var(--white);">
            <h1 class="section-title fade-in">Meet Our Team</h1>
            
            <!-- Team Filters -->
            <div class="team-filters fade-in">
                <button class="filter-btn active" data-category="all" onclick="filterTeam('all')">All Members</button>
                <button class="filter-btn" data-category="Lecture" onclick="filterTeam('Lecture')">Lecturers</button>
                <button class="filter-btn" data-category="researchers" onclick="filterTeam('researchers')">Researchers</button>
            </div>

            <!-- ============================================ -->
            <!-- LECTURERS (DOSEN PEMBIMBING) -->
            <!-- ============================================ -->
            <h3 id="lecturersTitle" class="team-subtitle fade-in">Dosen Pembimbing (Lecturers)</h3>
            <div class="team-grid">
                <!-- Lecturer 1 -->
                <div class="team-member fade-in" data-category="Lecture" onclick="openTeamModal('supervisor1')">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Ir. Runi Asmaranto, ST., MT., IPM., ASEAN Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Dam Expert</span>
                        <span class="team-tag">Reservoir and Dam Conservation</span>
                    </div>
                </div>
                
                <!-- Lecturer 2 -->
                <div class="team-member fade-in" data-category="Lecture" onclick="openTeamModal('supervisor2')">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Ir. Very Dermawan, ST., MT., IPM., ASEAN Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Hydraulics</span>
                    </div>
                </div>
                
                <!-- Lecturer 3 -->
                <div class="team-member fade-in" data-category="Lecture" onclick="openTeamModal('supervisor3')">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Sebrian Mirdeklis Beselly Putra., ST., MT., M.Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Engineering</span>
                    </div>
                </div>
                
                <!-- Lecturer 4 -->
                <div class="team-member fade-in" data-category="Lecture" onclick="openTeamModal('supervisor4')">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Muhammad Amar Sajali, ST., MT., M. Eng., Ph.D.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Numerical Modeling</span>
                    </div>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- RESEARCHERS -->
            <!-- ============================================ -->
            <h3 id="researchersTitle" class="team-subtitle fade-in">Research Team</h3>
            <div class="team-grid">
                <!-- Researcher 1 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher1')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Shareef Abdurrahim Yulianto</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Mangrove Studies</span>
                    </div>
                </div>
                
                <!-- Researcher 2 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher2')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Aan Mustaqim</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Mangrove Studies</span>
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                    </div>
                </div>
                
                <!-- Researcher 3 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher3')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Bilan Ayu Ardita</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Mangrove Studies</span>
                        <span class="team-tag">Coastal Dynamics</span>
                    </div>
                </div>
                
                <!-- Researcher 4 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher4')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Maharani Dewi Ayu Maulana Sinatria</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Mangrove Studies</span>
                    </div>
                </div>
                
                <!-- Researcher 5 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher5')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Laode Almay Fi Ahsany Taqwim</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Mangrove Studies</span>
                    </div>
                </div>
                
                <!-- Researcher 6 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher6')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Lhefiardo Syajidan Taqyuddin</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Mangrove Studies</span>
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Drone Topography</span>
                    </div>
                </div>
                
                <!-- Researcher 7 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher7')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Juan Carlos Tambunan</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                    </div>
                </div>
                
                <!-- Researcher 8 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher8')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Rafi Satria Sofriansyah</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Drone Topography</span>
                    </div>
                </div>
                
                <!-- Researcher 9 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher9')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Arwanda Maulana Rijal Al Fatah</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Drone Topography</span>
                        <span class="team-tag">Data Analysis</span>
                    </div>
                </div>
                
                <!-- Researcher 10 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher10')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Khalifa Firza Khafif Ar Razi</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Drone Topography</span>
                    </div>
                </div>
                
                <!-- Researcher 11 -->
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher11')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Muhammad Azzikri Aditya Gama</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- TEAM MODAL (Popup) -->
        <!-- ============================================ -->
        <div class="team-modal" id="teamModal">
            <div class="modal-content">
                <div class="modal-close" onclick="closeTeamModal()">
                    <i class="fas fa-times"></i>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Modal content will be dynamically inserted by JavaScript -->
                </div>
            </div>
        </div>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>