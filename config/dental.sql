-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2026 at 10:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `specialist` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `qualification`, `specialist`, `profile_image`, `description`, `created_at`) VALUES
(1, 'Dr. Rajiv Ranjan', 'M.D.S. (Oral Medicine & Radiology)    FAGE (Manipal)    Senior Lecturer, Vananchal Dental College (Garhwa)', 'Oral Medicine & Radiology (M.D.S.)', 'uploads/doctor-images/doc_6ae19dff11b8a0.04704214.jpeg', 'Dr. Rajiv Ranjan is a dental professional specializing in Oral Medicine and Radiology. He holds an M.D.S. degree and FAGE qualification from Manipal. He has also served as a Senior Lecturer at Vananchal Dental College, Garhwa. His expertise includes oral disease diagnosis, dental radiology, and the evaluation of oral and maxillofacial conditions.', '2026-10-28 07:02:23'),
(2, 'Dr. Vimmy', 'B.D.S. (Gold Medalist)', 'Certified Implantologist', 'uploads/doctor-images/doc_6ae19f403f35f9.00253266.png', 'Dr. Vimmy is a gold medalist dental professional and certified implantologist, specializing in dental implant treatments and tooth replacement solutions. She is dedicated to providing quality dental care, helping patients restore their smiles, improve oral function, and maintain long-term oral health.', '2026-10-28 07:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_name`, `created_at`) VALUES
(1, '1793176284_9851.png', '2026-10-28 08:31:24'),
(2, '1793176284_6870.png', '2026-10-28 08:31:24'),
(3, '1793176284_4818.png', '2026-10-28 08:31:24'),
(4, '1793176284_3388.png', '2026-10-28 08:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `hero_banners`
--

CREATE TABLE `hero_banners` (
  `id` int(11) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `btn_name` varchar(100) DEFAULT NULL,
  `btn_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero_banners`
--

INSERT INTO `hero_banners` (`id`, `subtitle`, `title`, `description`, `btn_name`, `btn_link`, `image`) VALUES
(1, 'Your Smile, Our Priority', 'Advanced Dental Care for Your Entire Family', 'Experience world-class dentistry with a gentle touch. We provide comprehensive oral care solutions in a comfortable, stress-free environment to keep your smile healthy for a lifetime.', 'Book Appointment', 'appointment.php', '1793009403_6adf26fb66d64.jpg'),
(2, 'Transform Your Confidence', 'Achieve the Perfect Smile You Deserve', 'From professional teeth whitening to complete smile makeovers with premium veneers. Our expert cosmetic dentists use state-of-the-art technology to craft your dream smile.', 'Explore Treatments', 'services.php', '1793009352_6adf26c8dfba2.jpg'),
(3, 'Fast & Painless Relief', 'Immediate Care for Dental Emergencies', 'Experiencing severe tooth pain, bleeding, or a broken tooth? Our dedicated emergency team is equipped to provide fast, compassionate, and effective treatments when you need them most.', 'Call Now', 'tel:08102605105', '1793009306_6adf269a55af9.jpg'),
(4, 'State-of-the-Art Restorations', 'Permanent Solutions with Dental Implants', 'Restore your missing teeth with natural-looking, durable dental implants. Regain your ability to eat, speak, and smile with absolute confidence using our precision-guided surgical techniques.', 'Get a Free Consultation', 'enquiry.php', '1793009249_6adf266108713.jpg'),
(5, 'Gentle Care for Little Smiles', 'Making Dental Visits Fun and Fearless', 'We create a welcoming, child-friendly environment to ensure your kids look forward to the dentist. Start your child\'s journey to lifelong oral health with our specialized pediatric team.', 'View Gallery', 'gallery.php', '1793009126_6adf25e6a1eba.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_desc` varchar(255) NOT NULL,
  `long_desc` text NOT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `sub_services` text DEFAULT NULL,
  `images` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `short_desc`, `long_desc`, `speciality`, `sub_services`, `images`, `created_at`) VALUES
(1, 'General & Family Care', 'Routine check-ups, fillings, and pediatric care for healthy family smiles.', 'General and family dentistry focuses on the prevention, diagnosis, and treatment of a wide variety of conditions, disorders, and diseases affecting the teeth, gums, and maxillofacial region of the body. Our comprehensive general and family care services are designed to ensure that every member of your family, from the youngest children to seniors, maintains optimal oral health throughout their lives. We provide thorough, routine check-ups and personalized consultations to catch any potential issues early. Our experienced team is skilled in performing painless extractions and applying durable fillings to restore damaged teeth gently. We also offer specialized pediatric dental care tailored to make children feel comfortable and safe during their visits, fostering a lifetime of good dental habits. In times of unexpected trouble, our emergency care promptly addresses pain and dangerous infections to bring you immediate relief. Additionally, we provide custom-fitted mouth guards and protective sealants to shield teeth from decay and physical trauma. By emphasizing preventive care and early intervention, we aim to keep your family\'s smiles bright, healthy, and pain-free for years to come.', 'General Dentistry', 'Comprehensive check-ups & consultations, Painless extractions & fillings, Pediatric dental care for children, Emergency care for pain & infections, Mouth guards & sealants', '1793077100_pexelspaveldanilyuk7055264.jpg,1793077100_pexelstherowdental215020925531017708.jpg', '2026-10-26 11:52:37'),
(2, 'Cosmetic Dentistry', 'Enhance your smile with whitening, veneers, cosmetic bonding, and gap closures.', 'Cosmetic dentistry is dedicated to improving the aesthetic appearance of your teeth, gums, and bite, ultimately transforming your smile and boosting your self-confidence. We understand that a beautiful smile is a powerful asset, which is why we offer a comprehensive suite of cosmetic treatments tailored to your unique facial features and personal goals. Our professional teeth whitening services effectively remove deep stains and discoloration, brightening your teeth by several shades in just one visit. For those seeking a complete transformation, our complete smile makeovers and digital smile designs meticulously plan out the perfect look. We utilize high-quality dental veneers and cosmetic crowns to permanently cover imperfections, misalignment, or severe discoloration. If you have chipped or slightly damaged teeth, our seamless cosmetic bonding procedures seamlessly restore their natural shape and function. Furthermore, we specialize in gentle gap closures and minor alignments that create a perfectly uniform, straight appearance without the need for extensive orthodontic work. Our commitment is to blend artistry with advanced dental science to deliver a radiant, natural-looking smile that you will be proud to show off.', 'Cosmetic Dentistry', 'Professional teeth whitening, Smile makeover & smile design, Dental veneers & cosmetic crowns, Cosmetic bonding for chipped teeth, Gap closure & minor alignment', '1793100836_pexelscottonbro6529119.jpg,1793100836_pexelskarolag6627575.jpg,1793100836_pexelskarolag6627572.jpg', '2026-10-26 11:52:37'),
(3, 'Endodontics (RCT)', 'Advanced, painless root canal treatments to save infected teeth and stop pain.', 'Endodontics is a highly specialized field of dentistry focused on diagnosing tooth pain and performing treatments on the dental pulp and tissues surrounding the roots of a tooth. When the inner pulp of a tooth becomes infected or severely inflamed due to deep decay, repeated dental procedures, or trauma, a root canal is necessary to save the tooth and prevent systemic infection. Our clinic utilizes advanced, state-of-the-art endodontic techniques to provide painless single or multi-visit root canal treatments (RCT), ensuring maximum patient comfort. We rely on microscopic precision procedures to meticulously clean, shape, and disinfect the complex root canal system before tightly sealing it. In cases where a previous treatment has failed or become reinfected, we are highly experienced in performing complex retreatments to restore the tooth\'s health. Once the root canal therapy is successfully completed, we provide custom-crafted post-RCT crowns and durable restorations to reinforce the tooth\'s structure, returning it to its full strength and natural appearance. Our goal is to alleviate your pain immediately while preserving your natural smile for a lifetime.', 'Endodontics', 'Advanced root canal treatment, Painless single/multi-visit RCT, Retreatment of failed RCT cases, Microscopic precision procedures, Post-RCT crowns & restorations', '1793100876_pexelsgustavofring4971541.jpg,1793100876_pexelsgustavofring4971515.jpg', '2026-10-26 11:52:37'),
(4, 'Orthodontics', 'Straighten teeth and correct bites using modern braces or invisible aligners.', 'Orthodontics focuses on diagnosing, preventing, and treating dental and facial irregularities, primarily misaligned teeth and jaws. A properly aligned bite not only improves your physical appearance but also significantly enhances oral function, making it easier to clean your teeth and reducing the risk of decay and gum disease. We offer a diverse range of modern orthodontic solutions to suit every lifestyle and aesthetic preference, including traditional metal braces, discreet ceramic braces, and highly effective clear braces. For patients seeking a virtually unnoticeable treatment option, we provide premium invisible aligners that offer exceptional comfort and convenience without sacrificing results. Our comprehensive treatments expertly correct crowded teeth, close unwanted spaces, and address complex jaw alignment and bite correction issues, such as overbites, underbites, and crossbites. Achieving your perfect smile is only part of the journey; we also provide custom-fitted retainers and thorough post-braces care instructions to ensure your teeth remain in their new, ideal positions permanently. We are dedicated to guiding you through a smooth, comfortable orthodontic experience that results in a functional, beautiful, and lasting smile.', 'Orthodontics', 'Metal, ceramic, and clear braces, Invisible aligners for comfort, Correction of crowded/spaced teeth, Jaw alignment & bite correction, Retainers & post-braces care', '1793100930_pexelskaplanart13207280.jpg,1793100930_pexelscottonbro6529115.jpg,1793100930_pexelsbakytzhanbaurzhanov8546009951391.jpg', '2026-10-26 11:52:37'),
(5, 'Implants & Surgery', 'Surgical tooth extraction, bone grafting, and permanent dental implant solutions.', 'Oral surgery and implantology involve advanced surgical procedures to restore missing teeth, treat complex oral diseases, and correct severe structural issues within the jaw. Dental implants are the most durable and natural-looking solution for tooth loss. We offer comprehensive implant services, ranging from single-tooth replacements to extensive multiple and full-mouth implant rehabilitations. To ensure the highest success rates for these implants, we perform meticulous bone grafting and site preparation, building a strong foundation in areas where the jawbone has deteriorated. Our highly trained oral surgeons also routinely perform the safe, surgical extraction of impacted or problematic wisdom teeth, minimizing discomfort and preventing future crowding or infection. Beyond extractions and implants, our surgical expertise extends to the expert management of jaw fractures and painful Temporomandibular Joint (TMJ) disorders, providing relief and restoring proper jaw function. Additionally, we are equipped to safely perform the biopsy and removal of cysts and various oral lesions to protect your long-term health. We utilize cutting-edge surgical techniques and prioritize rigorous patient safety protocols to deliver outstanding surgical outcomes and smooth recoveries.', 'Oral Surgery & Implantology', 'Single, multiple & full-mouth implants, Bone grafting & site preparation, Surgical extraction of wisdom teeth, Jaw fracture & TMJ management, Removal of cysts & oral lesions', '1793100977_pexelszeynepkahraman215714545238362421.jpg,1793100977_pexelsjonathanborba4687905.jpg', '2026-10-26 11:52:37'),
(6, 'Dentures & Radiology', 'Custom dentures and advanced 3D diagnostic imaging for precise treatments.', 'This comprehensive service combines expertly crafted dental prosthetics with state-of-the-art diagnostic imaging to ensure accurate diagnoses and functional restorations. Missing multiple teeth can severely impact your ability to speak, eat, and smile with confidence. To address this, we design and fabricate high-quality, custom full and partial dentures that fit comfortably and look entirely natural, restoring your facial aesthetics and chewing ability. For patients seeking maximum stability and confidence, we offer innovative implant-supported dentures that securely snap into place, eliminating slipping and the need for messy adhesives. The foundation of all our successful treatments is precise diagnostic imaging. Our advanced radiology department is fully equipped with digital dental and panoramic X-ray technology, which significantly reduces radiation exposure while providing immediate, high-definition images. For complex surgical planning, root canals, and implant placements, we utilize highly detailed 3D cone beam computed tomography (CT) scans. This cutting-edge diagnostic imaging allows our dental professionals to visualize the exact anatomy of your teeth, jawbone, and nerve pathways in three dimensions, ensuring every treatment is planned with pinpoint accuracy and executed safely.', 'Prosthodontics & Oral Radiology', 'Custom full & partial dentures, Implant-supported dentures, Digital dental & panoramic X-rays, 3D cone beam CT scans, Diagnostic imaging for treatments', '1793101028_pexelskarolag6627600.jpg,1793101028_pexelskarolag6627605.jpg', '2026-10-26 11:52:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_banners`
--
ALTER TABLE `hero_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hero_banners`
--
ALTER TABLE `hero_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
