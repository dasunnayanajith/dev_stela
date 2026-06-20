<?php

function sh_default_testimonials()
{
    return [
        [
            'id' => 1,
            'client_name' => 'Kamlesh Domah',
            'client_location' => 'Mauritius',
            'rating' => 5,
            'image_filename' => 'testim_3.jpg',
            'testimonial_text' => 'I really enjoyed the Ayurveda tour, which I customized to do some sight-seeing as well. Mr. Lal went out of his way to make the tour memorable, driving for over 10 hours on some days so that I could see as much as possible, and get a good dive into the Sri Lankan culture, cuisine and lifestyle.',
        ],
        [
            'id' => 2,
            'client_name' => 'Susan Ramsey',
            'client_location' => 'USA',
            'rating' => 5,
            'image_filename' => 'testim_1.jpg',
            'testimonial_text' => 'My teenage granddaughter and I choose the Stelaran Holidays 13 Day Elephant Tour based on reviews and the time that would be spent with or near Elephants. Elli has loved Elephants since she was small and this was her Dream Trip. We were NOT disappointed! The tour is ALL it says it is and SO much more. The island of Sri Lanka is magical! This country is very diverse in heritage, culture, geography, plant and animal life. Each day was an exciting new adventure! The people of Sri Lanka are so kind and hospitable, they made our trip personal. Our guide, Chandana was extremely knowledgeable about everything and went above and beyond to make sure our experience was good. We highly recommended this Tour!',
        ],
        [
            'id' => 3,
            'client_name' => 'Doug Harwood',
            'client_location' => 'USA',
            'rating' => 5,
            'image_filename' => 'testim_6.jpg',
            'testimonial_text' => 'Our Guide Mr. Chandana was absolutely wonderful. He knew just what we liked and did not as he took the time to get to know us. We had a wonderful time on the beautiful beaches and wandering the town. To see all the hidden gems of Sri Lanka you need someone so knowledgeable.',
        ],
        [
            'id' => 4,
            'client_name' => 'Klaudia Sarah',
            'client_location' => 'Doha Qatar',
            'rating' => 5,
            'image_filename' => 'testim_4.jpg',
            'testimonial_text' => 'We are two solo women travelers from Doha, Qatar, who recently embarked on an exciting journey with Stelaran Holidays solo holidays tour. Despite heavy rain during the first days, we enjoyed every moment thanks to our fantastic guide Chandana. His kindness and expertise greatly enhanced our experience, making it a trip to remember.',
        ],
        [
            'id' => 5,
            'client_name' => 'Alisa Sierra',
            'client_location' => 'UK',
            'rating' => 5,
            'image_filename' => 'testim_5.jpg',
            'testimonial_text' => 'Looking to make your holiday dreams a reality? Look no further than Stelaran Holidays. Our recent excursion to Sri Lanka left us utterly enchanted. From the initial planning stages to the final farewell, Stelaran Holidays exceeded our expectations. Their dedication to crafting the perfect itinerary and their swift, helpful responses made the entire process seamless.',
        ],
        [
            'id' => 6,
            'client_name' => 'Rodrigo Mariya',
            'client_location' => 'Denmark',
            'rating' => 5,
            'image_filename' => 'testim_8.jpg',
            'testimonial_text' => 'My family had the most incredible 17-day trip to Sri Lanka. Right from the start I knew they were the tour company for me. I highly recommend this tour, very well organized and we managed to see 15 cities in 17 days. The communication before and during the trip was excellent.',
        ],
        [
            'id' => 7,
            'client_name' => 'Suzanne',
            'client_location' => 'Canada',
            'rating' => 5,
            'image_filename' => 'testim_1.jpg',
            'testimonial_text' => 'It is a lot of fun and I saw everything I wanted to see. Bring a good camera because you see lots of birds and animals at the national parks you visit. My guide was awesome. He really looked after me, and as I was travelling alone I was a little worried. I highly recommend this tour and this company!',
        ],
        [
            'id' => 8,
            'client_name' => 'Pushpa',
            'client_location' => 'New York',
            'rating' => 5,
            'image_filename' => 'testim_2.jpg',
            'testimonial_text' => 'This was a very good experience for me and I really enjoyed all the treatments and massages. The driver and guide was kind, punctual and informative. Sonali was very helpful, responsive and went above and beyond to fulfill my needs. I would use Stelaran Holidays again.',
        ],
    ];
}

function sh_default_book_tour_prompts()
{
    return [
        'title' => ['Mr.', 'Mrs.', 'Ms.', 'Miss.', 'Dr.', 'Prof.'],
        'accommodation' => ['5 Star Hotels', '4 Star Hotels', '3 Star Hotels', 'Luxury Boutiques', 'Wallet Friendly'],
        'found_us' => ['Tripadvisor', 'Website', 'Google', 'Social Media', 'Other'],
    ];
}

function sh_get_testimonials($dbh)
{
    try {
        $sql = "SELECT id, client_name, client_location, rating, image_filename, testimonial_text
                FROM tbltestimonials
                WHERE is_active = 1
                ORDER BY display_order ASC, id ASC";
        $query = $dbh->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        return $rows ?: sh_default_testimonials();
    } catch (Exception $e) {
        return sh_default_testimonials();
    }
}

function sh_get_book_tour_options($dbh, $promptType)
{
    $defaults = sh_default_book_tour_prompts();
    try {
        $sql = "SELECT option_label
                FROM tblbooktourprompts
                WHERE prompt_type = :prompt_type AND is_active = 1
                ORDER BY display_order ASC, id ASC";
        $query = $dbh->prepare($sql);
        $query->bindParam(':prompt_type', $promptType, PDO::PARAM_STR);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_COLUMN);
        return $rows ?: ($defaults[$promptType] ?? []);
    } catch (Exception $e) {
        return $defaults[$promptType] ?? [];
    }
}

function sh_ensure_content_tables($dbh)
{
    $dbh->exec("CREATE TABLE IF NOT EXISTS tbltestimonials (
        id INT NOT NULL AUTO_INCREMENT,
        client_name VARCHAR(150) NOT NULL,
        client_location VARCHAR(150) DEFAULT NULL,
        rating TINYINT NOT NULL DEFAULT 5,
        image_filename VARCHAR(150) DEFAULT NULL,
        testimonial_text TEXT NOT NULL,
        display_order INT NOT NULL DEFAULT 0,
        is_active TINYINT(1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $dbh->exec("CREATE TABLE IF NOT EXISTS tblbooktourprompts (
        id INT NOT NULL AUTO_INCREMENT,
        prompt_type VARCHAR(50) NOT NULL,
        option_label VARCHAR(150) NOT NULL,
        display_order INT NOT NULL DEFAULT 0,
        is_active TINYINT(1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY prompt_type (prompt_type)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $count = (int) $dbh->query("SELECT COUNT(*) FROM tbltestimonials")->fetchColumn();
    if ($count === 0) {
        $sql = "INSERT INTO tbltestimonials
                (client_name, client_location, rating, image_filename, testimonial_text, display_order, is_active)
                VALUES (:client_name, :client_location, :rating, :image_filename, :testimonial_text, :display_order, 1)";
        $query = $dbh->prepare($sql);
        foreach (sh_default_testimonials() as $index => $testimonial) {
            $order = $index + 1;
            $query->execute([
                ':client_name' => $testimonial['client_name'],
                ':client_location' => $testimonial['client_location'],
                ':rating' => $testimonial['rating'],
                ':image_filename' => $testimonial['image_filename'],
                ':testimonial_text' => $testimonial['testimonial_text'],
                ':display_order' => $order,
            ]);
        }
    }

    $count = (int) $dbh->query("SELECT COUNT(*) FROM tblbooktourprompts")->fetchColumn();
    if ($count === 0) {
        $sql = "INSERT INTO tblbooktourprompts
                (prompt_type, option_label, display_order, is_active)
                VALUES (:prompt_type, :option_label, :display_order, 1)";
        $query = $dbh->prepare($sql);
        foreach (sh_default_book_tour_prompts() as $type => $options) {
            foreach ($options as $index => $label) {
                $query->execute([
                    ':prompt_type' => $type,
                    ':option_label' => $label,
                    ':display_order' => $index + 1,
                ]);
            }
        }
    }
}

function sh_prompt_type_label($type)
{
    $labels = [
        'title' => 'Title',
        'accommodation' => 'Accommodation',
        'found_us' => 'Found Us',
    ];
    return $labels[$type] ?? $type;
}
