<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Law Firm Chatbot</title>
     <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Carousel -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="css/chatbot.css" rel="stylesheet">
    
    <style>
        .header {
            background: var(--primary);
            padding: 15px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo {
            color: var(--white);
            text-decoration: none;
            font-size: 1.8rem;
            font-weight: 700;
            font-family: 'Cormorant', serif;
            transition: color 0.3s ease;
        }

        .logo span {
            color: var(--secondary);
        }

        .logo:hover {
            color: var(--secondary);
        }

        .navbar {
            padding: 0;
        }

        .navbar-nav {
            gap: 10px;
        }

        .nav-link {
            color: var(--gray-200) !important;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 8px 15px !important;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--white) !important;
            background: rgba(255,255,255,0.1);
        }

        .btn-outline {
            color: var(--white);
            border: 2px solid var(--secondary);
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: var(--secondary);
            color: var(--white);
            transform: translateY(-2px);
        }

        .user-welcome {
            color: var(--gray-200);
            margin-right: 15px;
            font-size: 0.95rem;
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background: var(--primary);
                padding: 15px;
                border-radius: 8px;
                margin-top: 10px;
            }

            .navbar-nav {
                gap: 5px;
            }

            .nav-link {
                padding: 10px 15px !important;
            }

            .user-welcome {
                margin: 10px 0;
                display: block;
            }

            .btn-outline {
                display: inline-block;
                margin-top: 10px;
            }
        }

        /* Adjust main content to account for fixed header */
        body {
            padding-top: 80px;
        }

        /* Remove the back link as we have the navigation */
        .back-link {
            display: none;
        }
    </style>
</head>
<body>
   <?php  
include 'db.php';
?>
 <header class="header">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-lg-2">
                 <a href="index.php" class="logo">The<span>Firm</span></a>
             </div>
             <div class="col-lg-10">
                 <nav class="navbar navbar-expand-lg navbar-dark">
                     <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarNav">
                         <ul class="navbar-nav mx-auto">
                             <li class="nav-item">
                                 <a class="nav-link" href="index.php">Home</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="practice.php">Practice Areas</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="attorneys.php">Attorneys</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="cases.php">Cases</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="contact.php">Contact</a>
                             </li>
                             

                             <?php
                                if(isset($_SESSION['user'])){
                                $sql1 = "SELECT * FROM user WHERE id=" . $_SESSION['user']['id'];
                                $result1 = $conn->query($sql1);
                                $row1 = $result1->fetch_assoc();
                                
                                $sql2 = "SELECT * FROM `case` WHERE userid=" . $row1['id'];
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                
                                if ($row2 && isset($row2['status']) && $row2['status'] == 'Accepted') {
                                    echo '<li class="nav-item"><a class="nav-link" href="track.php">Track Your Case</a></li>';
                                }
                                
                                $sql2 = "SELECT * FROM `cv` WHERE userid=" . $row1['id'];
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                
                                if ($row2 && isset($row2['status']) && $row2['status'] == 'Accepted') {
                                    echo '<li class="nav-item"><a class="nav-link" href="application.php">Track Your Application</a></li>';
                                }
                            }
                                ?>
                         </ul>
                                
                         </div>
                     </div>
                 </nav>
             </div>
         </div>
     </div>
 </header>
    <div class="chat-container">
        <div class="chat-header">
            Law Firm Virtual Assistant
        </div>
        <div class="chat-box" id="chat-box">
            <!-- Messages will appear here -->
        </div>
        <div class="user-input">
            <input type="text" id="user-message" placeholder="Type your question here..." autocomplete="off">
            <button id="send-button">Send</button>
        </div>
    </div>

    <script>
        document.getElementById("send-button").addEventListener("click", function() {
            var userMessage = document.getElementById("user-message").value;
            
            if (userMessage.trim() === "") {
                return;
            }

            displayMessage(userMessage, "user");

            // Process and get bot response
            var botResponse = getBotResponse(userMessage);
            setTimeout(() => {
                displayMessage(botResponse, "bot");
            }, 1000);

            document.getElementById("user-message").value = ""; // Clear the input box
        });

        function displayMessage(message, sender) {
            var chatBox = document.getElementById("chat-box");
            var msg = document.createElement("p");
            msg.classList.add(sender === "user" ? "user-msg" : "bot-msg");
            msg.textContent = message;
            chatBox.appendChild(msg);
            chatBox.scrollTop = chatBox.scrollHeight; // Auto scroll to the bottom
        }

       function getBotResponse(userMessage) {
    userMessage = userMessage.trim().toLowerCase();

    if (userMessage.includes("hours") || userMessage.includes("open") || userMessage.includes("working hours")) {
        return "Our office is open Monday to Friday, from 8:00 AM to 9:00 PM.";
    } else if (userMessage.includes("location") || userMessage.includes("address") || userMessage.includes("where are you located")) {
        return "We are located at Qubic Square Business, Sin El Fil, Beirut, Lebanon.";
    } else if (userMessage.includes("specialize") || userMessage.includes("types of law")) {
        return "We specialize in family law, criminal law, political law, educational law, business law, immigration law, personal injury, and estate planning.";
    } else if (userMessage.includes("contact") || userMessage.includes("phone") || userMessage.includes("email")) {
        return "You can reach us at 555-1234 or email thefirm.contact.leb@lawfirm.com.";
    } else if (userMessage.includes("free consultations") || userMessage.includes("initial consultation") || userMessage.includes("consultation")) {
        return "Yes, we offer a free initial consultation.";
    } else if (userMessage.includes("how long has your firm been in business")) {
        return "Our firm has been in business for over 20 years.";
    } else if (userMessage.includes("qualifications")) {
        return "Our team consists of experienced lawyers with qualifications from top law schools and years of experience in their respective fields.";
    } else if (userMessage.includes("speak with a specific lawyer")) {
        return "Yes, you can request to speak with a specific lawyer. Please provide their name and we will arrange the meeting.";
    } else if (userMessage.includes("family law")) {
        return "Family law covers matters such as divorce, child custody, adoption, and domestic violence.";
    } else if (userMessage.includes("divorce") || userMessage.includes("separation")) {
        return "To file for divorce, you need to submit a petition to the court. Our lawyers can guide you through the process.";
    } else if (userMessage.includes("personal injury")) {
        return "If you've been injured in an accident, we can help you file a personal injury claim. We will fight for fair compensation.";
    } else if (userMessage.includes("criminal charges")) {
        return "If you're facing criminal charges, it's important to have an experienced lawyer. We can help defend your case.";
    } else if (userMessage.includes("business law") || userMessage.includes("business contracts")) {
        return "Business law covers a wide range of issues such as starting a business, contracts, mergers, and acquisitions.";
    } else if (userMessage.includes("fees")) {
        return "Our fees vary depending on the type of case. We offer both hourly rates and flat fees. Please contact us for more details.";
    } else if (userMessage.includes("payment plan")) {
        return "Yes, we offer payment plans for legal services.";
    } else if (userMessage.includes("consultation")) {
        return "During your consultation, we will assess your case and explain your options moving forward.";
    } else if (userMessage.includes("case status") || userMessage.includes("case update")) {
        return "You can contact us for the status of your case or request an update through our client portal.";
    } else if (userMessage.includes("court hearing")) {
        return "Once your case is filed, we will notify you about the date and time of your court hearing.";
    } else if (userMessage.includes("documents")) {
        return "Please bring all relevant documents to your first consultation, including any court filings, contracts, or communication related to your case.";
    } else if (userMessage.includes("mediation")) {
        return "We offer mediation services to help parties resolve their disputes outside of court.";
    } else if (userMessage.includes("arbitration")) {
        return "Arbitration is a process where a neutral third party hears both sides of a dispute and makes a binding decision.";
    } else if (userMessage.includes("settle out of court")) {
        return "We can help you negotiate a settlement to avoid the time and expense of a trial.";
    } else if (userMessage.includes("joint custody")) {
        return "Joint custody refers to an arrangement where both parents share the responsibility for raising their children after a divorce.";
    } else if (userMessage.includes("child support")) {
        return "Child support is typically calculated based on the income of both parents and the needs of the child.";
    } else if (userMessage.includes("prenuptial agreement")) {
        return "A prenuptial agreement outlines the financial terms and responsibilities of each spouse in case of a divorce.";
    } else if (userMessage.includes("adopt a child")) {
        return "We can help guide you through the legal process of adoption, ensuring that you meet all the necessary requirements.";
    } else if (userMessage.includes("arrest")) {
        return "If you are arrested, it's important to contact a lawyer immediately to understand your rights and options.";
    } else if (userMessage.includes("misdemeanor") || userMessage.includes("felony")) {
        return "A misdemeanor is a less severe criminal offense, while a felony is more serious and may result in harsher penalties.";
    } else if (userMessage.includes("expunge")) {
        return "Expungement is the legal process of sealing or removing a criminal record from public view.";
    } else if (userMessage.includes("insurance claim") || userMessage.includes("injury claim")) {
        return "We can assist you in filing a claim for injury and ensuring you receive the proper compensation.";
    } else if (userMessage.includes("business setup") || userMessage.includes("set up a business")) {
        return "We provide legal guidance for setting up a business, including forming partnerships, corporations, and ensuring legal compliance.";
    } else if (userMessage.includes("visa")) {
        return "We can help you with the visa application process, whether it's for work, study, or family reasons.";
    } else if (userMessage.includes("green card")) {
        return "We can assist you in applying for a green card and navigating the process of becoming a permanent resident.";
    } else if (userMessage.includes("deportation")) {
        return "If you are facing deportation, we recommend seeking immediate legal counsel. We are here to help.";
    } else if (userMessage.includes("will")) {
        return "A will is a legal document that outlines how your assets will be distributed after your death. It's important to have one in place.";
    } else if (userMessage.includes("trust")) {
        return "A trust allows a person to transfer assets to a trustee to manage for the benefit of beneficiaries.";
    } else if (userMessage.includes("power of attorney")) {
        return "A power of attorney gives someone the legal authority to act on your behalf in financial or legal matters.";
    } else if (userMessage.includes("trust a lawyer")) {
        return "You can trust our experienced and ethical lawyers to handle your case with care and professionalism.";
    } else if (userMessage.includes("legal malpractice")) {
        return "Legal malpractice refers to a situation where a lawyer fails to meet professional standards, resulting in harm to a client.";
    } else if (userMessage.includes("complaint against lawyer")) {
        return "If you wish to file a complaint against a lawyer, we can guide you through the process and advise on the next steps.";
    } else if (userMessage.includes("legal advice")) {
        return "We offer legal advice on a variety of issues. Please provide more details about your situation.";
    } else if (userMessage.includes("legal representation")) {
        return "We provide legal representation in court and during negotiations. Please contact us for more information.";
    } else if (userMessage.includes("law firm")) {
        return "We are a full-service law firm dedicated to providing quality legal services to our clients.";
    } else if (userMessage.includes("lawyer")) {
        return "Our lawyers are experienced in various fields of law and are here to help you with your legal needs.";
    } else if (userMessage.includes("hello") || userMessage.includes("hi") || userMessage.includes("hey")) {
        return "Hello! How can I assist you today?";
    } else if (userMessage.includes("bye") || userMessage.includes("goodbye")) {
        return "Goodbye! If you have any more questions, feel free to ask.";
    } else if (userMessage.includes("thank you") || userMessage.includes("thanks")) {
        return "You're welcome! If you have any more questions, feel free to ask.";
    } else if (userMessage.includes("help")) {
        return "Sure! What do you need help with?";
    } else if (userMessage.includes("appointment")) {
        return "You can schedule an appointment by calling our office or using our online booking system.";
    } else if (userMessage.includes("case")) {
        return "Please provide more details about your case so we can assist you better.";
    } else if (userMessage.includes("lawyer fees")) {
        return "Our lawyer fees vary based on the type of case and complexity. Please contact us for more details.";
    } else if (userMessage.includes("legal documents")) {
        return "We can help you prepare and review legal documents. Please provide more details about what you need.";
    } else if (userMessage.includes("court process")) {
        return "The court process can vary depending on the type of case. We can guide you through each step.";
    } else if (userMessage.includes("legal rights")) {
        return "Your legal rights depend on your situation. Please provide more details for specific information.";
    } else if (userMessage.includes("legal consultation")) {
        return "We offer legal consultations to discuss your case and provide advice. Please contact us to schedule one.";
    } else if (userMessage.includes("legal issues")) {
        return "We can help you with various legal issues. Please provide more details about your situation.";
    } else if (userMessage.includes("legal assistance")) {
        return "We offer legal assistance for a variety of cases. Please contact us for more information.";
    } else if (userMessage.includes("law firm history")) {
        return "Our law firm has a rich history of serving clients with dedication and professionalism.";
    } else if (userMessage.includes("law firm reputation")) {
        return "We have built a strong reputation for providing quality legal services and achieving favorable outcomes for our clients.";
    } else if (userMessage.includes("law firm values")) {
        return "Our law firm values integrity, professionalism, and commitment to our clients.";
    } else if (userMessage.includes("law firm mission")) {
        return "Our mission is to provide exceptional legal services and advocate for our clients' best interests.";
    } else if (userMessage.includes("law firm vision")) {
        return "Our vision is to be a leading law firm known for our expertise and dedication to client success.";
    } else if (userMessage.includes("law firm team")) {
        return "Our team consists of experienced lawyers and legal professionals dedicated to serving our clients.";
    } else if (userMessage.includes("law firm services")) {
        return "We offer a wide range of legal services, including family law, criminal defense, business law, and more.";
    } else if (userMessage.includes("what is criminal law") || userMessage.includes("criminal law")) {
    return "Criminal law involves the prosecution by the government of a person for an act that has been classified as a crime. It includes offenses like theft, assault, fraud, and murder.";
}
else if (userMessage.includes("educational law") || userMessage.includes("education law")) {
    return "Educational law governs schools and education systems. It includes issues like student rights, school discipline, special education, and teacher employment.";
}
else if (userMessage.includes("civil rights law") || userMessage.includes("civil rights")) {
    return "Civil rights law protects individuals against discrimination and ensures equal treatment regardless of race, gender, disability, or religion.";
}
else if (userMessage.includes("employment law") || userMessage.includes("labor law")) {
    return "Employment law covers the rights and duties between employers and employees. It includes topics like workplace discrimination, wages, and wrongful termination.";
}
else if (userMessage.includes("bankruptcy law") || userMessage.includes("file for bankruptcy")) {
    return "Bankruptcy law helps individuals or businesses who can't repay their debts. We can guide you through Chapter 7 or Chapter 13 bankruptcy filings.";
}
else if (userMessage.includes("intellectual property") || userMessage.includes("copyright") || userMessage.includes("patent") || userMessage.includes("trademark")) {
    return "Intellectual property law protects your creations like inventions, brand names, logos, and artistic works through patents, copyrights, and trademarks.";
}
else if (userMessage.includes("real estate law") || userMessage.includes("buying property") || userMessage.includes("selling property")) {
    return "Real estate law covers the purchase, sale, or leasing of property. We can help with contracts, titles, and resolving disputes.";
}
else if (userMessage.includes("elder law")) {
    return "Elder law addresses legal issues affecting older adults, including estate planning, guardianship, Medicare, and elder abuse.";
}
else if (userMessage.includes("tax law") || userMessage.includes("tax issues")) {
    return "Tax law involves the rules and procedures for paying taxes to local, state, or federal governments. We help with disputes, audits, and tax planning.";
}
else if (userMessage.includes("environmental law")) {
    return "Environmental law regulates how people interact with the environment. It includes laws about pollution, natural resources, and conservation.";
}
else if (userMessage.includes("patent") || userMessage.includes("trademark") || userMessage.includes("copyright")) {
    return "These are types of intellectual property. We can help protect your ideas, inventions, and brand identity.";
}

else if (userMessage.includes("how much do you charge") || userMessage.includes("cost of legal services")) {
    return "Our fees depend on the complexity and type of case. We offer transparent pricing and flexible options.";
}
else if (userMessage.includes("emergency legal help") || userMessage.includes("urgent legal help")) {
    return "If you're facing a legal emergency, please call us immediately. We're here to help 24/7 in urgent situations.";
}
else if (userMessage.includes("restraining order")) {
    return "We can help you file for a restraining order and ensure your safety through legal channels.";
}
else if (userMessage.includes("guardianship") || userMessage.includes("legal guardian")) {
    return "Guardianship refers to the legal responsibility over a minor or incapacitated adult. We can help you apply for guardianship.";
}
else if (userMessage.includes("legal aid") || userMessage.includes("pro bono")) {
    return "We offer limited legal aid and may provide pro bono services depending on your case and circumstances.";
}
else if (userMessage.includes("legal capacity")) {
    return "Legal capacity refers to a person's ability to enter into binding legal agreements. We can assess and advise based on your situation.";
}
else if (userMessage.includes("notarize") || userMessage.includes("notary")) {
    return "Yes, we provide notary services for legal documents. Please call to schedule an appointment.";
}
else if (userMessage.includes("legal capacity")) {
    return "Legal capacity refers to the ability to understand and engage in legal decisions or contracts.";
}
else if (userMessage.includes("legal separation")) {
    return "Legal separation is a court-approved arrangement where a married couple lives separately but remains legally married.";
}
else if (userMessage.includes("property division")) {
    return "Property division in divorce is handled based on marital and non-marital assets. We can help ensure fair distribution.";
}
else if (userMessage.includes("spousal support") || userMessage.includes("alimony")) {
    return "Spousal support, or alimony, may be awarded depending on the length of the marriage and each spouse’s financial situation.";
}
else if (userMessage.includes("estate planning")) {
    return "Estate planning helps manage your assets for the future. We offer wills, trusts, and tax-efficient strategies.";
}
else if (userMessage.includes("living will")) {
    return "A living will outlines your medical wishes if you become unable to communicate. We can help you draft one.";
}
else if (userMessage.includes("DUI") || userMessage.includes("drunk driving")) {
    return "If you're facing a DUI charge, it’s important to act quickly. Our defense attorneys are here to support you.";
}
else if (userMessage.includes("tenant rights") || userMessage.includes("landlord dispute")) {
    return "We handle landlord-tenant disputes and can help protect your rights under the law.";
}
else if (userMessage.includes("small claims court")) {
    return "Small claims court handles minor disputes without needing a lawyer. We can help you prepare your case.";
}
else if (userMessage.includes("civil lawsuit")) {
    return "A civil lawsuit involves a dispute between parties over legal duties and responsibilities. We can represent you throughout the process.";
}
else if (userMessage.includes("contract dispute")) {
    return "If you're involved in a contract dispute, we can help interpret the terms and seek a resolution in or out of court.";
}
else if (userMessage.includes("legal document review")) {
    return "We offer professional review of contracts, agreements, and other legal documents to ensure your rights are protected.";
}
else if (userMessage.includes("non-disclosure agreement") || userMessage.includes("NDA")) {
    return "We draft and review non-disclosure agreements to protect your confidential information.";
}
else if (userMessage.includes("cease and desist")) {
    return "A cease and desist letter is a formal request to stop an activity. We can draft or respond to such letters on your behalf.";
}
else if (userMessage.includes("defamation") || userMessage.includes("libel") || userMessage.includes("slander")) {
    return "Defamation law protects you from false statements that damage your reputation. We can help you take legal action.";
} 

else if (userMessage.includes("cyber law") || userMessage.includes("internet law")) {
    return "Cyber law deals with legal issues related to the internet, digital communications, and cybercrimes like hacking and data breaches.";
}
else if (userMessage.includes("international law")) {
    return "International law governs relations between nations and includes treaties, international agreements, and global human rights.";
}
else if (userMessage.includes("maritime law") || userMessage.includes("admiralty law")) {
    return "Maritime law covers issues that occur on navigable waters, including shipping, marine commerce, and ocean policy.";
}
else if (userMessage.includes("space law")) {
    return "Space law includes international and national laws governing activities in outer space, including satellite use and exploration.";
}
else if (userMessage.includes("constitutional law")) {
    return "Constitutional law involves interpreting and applying a country's constitution, including rights and governmental powers.";
}
else if (userMessage.includes("antitrust law") || userMessage.includes("competition law")) {
    return "Antitrust law ensures fair business practices and prevents monopolies or anti-competitive behavior in the market.";
}
else if (userMessage.includes("securities law") || userMessage.includes("investment fraud")) {
    return "Securities law regulates the trading of financial instruments and aims to prevent fraud in the investment markets.";
}
else if (userMessage.includes("military law") || userMessage.includes("court martial")) {
    return "Military law applies to members of the armed forces and governs conduct, discipline, and court-martial procedures.";
}
else if (userMessage.includes("administrative law")) {
    return "Administrative law deals with government agencies' rules, regulations, and decisions, and your right to appeal them.";
}
else if (userMessage.includes("transportation law")) {
    return "Transportation law regulates travel and commerce across roads, airways, railroads, and sea routes.";
}
else if (userMessage.includes("aviation law") || userMessage.includes("airline law")) {
    return "Aviation law covers legal issues involving air travel, pilot licensing, aircraft operations, and passenger rights.";
}
else if (userMessage.includes("media law") || userMessage.includes("broadcast law")) {
    return "Media law addresses issues related to broadcasting, censorship, freedom of speech, and content ownership.";
}
else if (userMessage.includes("telecommunications law")) {
    return "Telecommunications law regulates phone, internet, and digital communication services, including privacy and data handling.";
}
else if (userMessage.includes("healthcare law") || userMessage.includes("medical law")) {
    return "Healthcare law governs the rights and responsibilities of medical providers and patients, including malpractice and consent.";
}
else if (userMessage.includes("sports law")) {
    return "Sports law handles contracts, disputes, and regulatory compliance in professional and amateur athletics.";
}
else if (userMessage.includes("entertainment law") || userMessage.includes("music contracts")) {
    return "Entertainment law involves legal services for artists, including contracts, licensing, and intellectual property.";
}
else if (userMessage.includes("human rights law")) {
    return "Human rights law protects individuals' fundamental freedoms and ensures equal treatment under international standards.";
}
else if (userMessage.includes("immigration appeal") || userMessage.includes("visa denial")) {
    return "We assist with immigration appeals and help you challenge visa or green card denials legally.";
}
else if (userMessage.includes("student visa")) {
    return "We help with student visa applications, renewals, and address issues with school transfers or status changes.";
}
else if (userMessage.includes("investor visa") || userMessage.includes("EB-5")) {
    return "We assist with investor visa applications, such as EB-5, including business planning and compliance.";
}


else if (userMessage.includes("lebanese constitution")) {
    return "The Lebanese Constitution is the fundamental law that outlines the political system and guarantees basic rights and freedoms.";
}
else if (userMessage.includes("lebanese penal code") || userMessage.includes("criminal code lebanon")) {
    return "The Lebanese Penal Code defines crimes and penalties under Lebanese law, including theft, assault, and defamation.";
}
else if (userMessage.includes("civil code lebanon") || userMessage.includes("lebanese civil law")) {
    return "Lebanese Civil Law governs contracts, obligations, property, and family law issues between private individuals.";
}
else if (userMessage.includes("religious courts lebanon") || userMessage.includes("sectarian courts")) {
    return "In Lebanon, personal status matters such as marriage, divorce, and inheritance are handled by religious courts depending on your sect.";
}
else if (userMessage.includes("marriage law lebanon") || userMessage.includes("civil marriage lebanon")) {
    return "Lebanon does not allow civil marriage within its territory, but recognizes civil marriages performed abroad.";
}
else if (userMessage.includes("divorce in lebanon")) {
    return "Divorce procedures in Lebanon depend on religious affiliation. Each sect has its own laws and court system.";
}
else if (userMessage.includes("inheritance law lebanon")) {
    return "Inheritance in Lebanon is governed by religious laws. Rules vary by sect and can affect asset division and heir eligibility.";
}
else if (userMessage.includes("labor law lebanon") || userMessage.includes("employee rights lebanon")) {
    return "Lebanese Labor Law governs employment terms, contracts, wages, termination, and worker protections.";
}
else if (userMessage.includes("residency law lebanon") || userMessage.includes("work permit lebanon")) {
    return "Foreign nationals in Lebanon must obtain proper residency and work permits from the General Security Directorate.";
}
else if (userMessage.includes("commercial law lebanon") || userMessage.includes("business law lebanon")) {
    return "Lebanese Commercial Law regulates companies, contracts, commercial agencies, and trade regulations.";
}
else if (userMessage.includes("tax law lebanon") || userMessage.includes("vat lebanon")) {
    return "Lebanese tax law includes income tax, corporate tax, and VAT. We can help you with compliance and filing.";
}
else if (userMessage.includes("real estate law lebanon") || userMessage.includes("buy property in lebanon")) {
    return "Real estate transactions in Lebanon require due diligence, notary involvement, and sometimes foreign ownership approval.";
}
else if (userMessage.includes("lebanese traffic law") || userMessage.includes("driving law lebanon")) {
    return "Lebanon's traffic law governs road use, licensing, violations, and penalties for unsafe driving.";
}
else if (userMessage.includes("cybercrime lebanon") || userMessage.includes("electronic crime lebanon")) {
    return "Lebanese law criminalizes cybercrimes such as hacking, online defamation, and misuse of personal data.";
}
else if (userMessage.includes("press law lebanon") || userMessage.includes("media law lebanon")) {
    return "The Lebanese Press Law governs newspapers, online media, defamation, and freedom of expression.";
}
else if (userMessage.includes("non-profit law lebanon") || userMessage.includes("ngo registration lebanon")) {
    return "To register an NGO in Lebanon, you must follow the Ministry of Interior procedures and comply with local association laws.";
}
else if (userMessage.includes("military service lebanon")) {
    return "Lebanon does not currently have mandatory military service, but reserve duty and military court jurisdiction may apply.";
}
else if (userMessage.includes("anti-corruption law lebanon") || userMessage.includes("accountability law lebanon")) {
    return "Lebanon has passed anti-corruption laws including the Right to Access Information and whistleblower protections.";
}
else if (userMessage.includes("bank secrecy law lebanon") || userMessage.includes("financial transparency lebanon")) {
    return "Lebanon's banking secrecy law was lifted for judicial investigations in certain cases of corruption or financial crimes.";
}


else if (userMessage.includes("lebanese nationality law") || userMessage.includes("citizenship lebanon")) {
    return "Lebanese nationality is primarily passed through the father. Women cannot pass citizenship to their children or spouses unless certain exceptions apply.";
}
else if (userMessage.includes("refugee law lebanon") || userMessage.includes("asylum lebanon")) {
    return "Lebanon is not a signatory to the 1951 Refugee Convention, but it hosts large refugee populations. UNHCR plays a key role in refugee protection.";
}
else if (userMessage.includes("human rights lebanon")) {
    return "Human rights in Lebanon are protected under international agreements and the constitution, but enforcement and protections vary widely.";
}
else if (userMessage.includes("lebanese court system") || userMessage.includes("types of courts in lebanon")) {
    return "Lebanon has a dual court system: civil and religious. It includes courts of first instance, appeals courts, cassation court, and a constitutional council.";
}
else if (userMessage.includes("military courts lebanon")) {
    return "Military courts in Lebanon handle cases involving military personnel and sometimes civilians, which raises human rights concerns.";
}
else if (userMessage.includes("constitutional council lebanon")) {
    return "The Constitutional Council oversees the constitutionality of laws and elections. Citizens cannot directly file complaints to it.";
}
else if (userMessage.includes("data protection lebanon") || userMessage.includes("privacy law lebanon")) {
    return "Lebanon's data protection framework is limited, but Law No. 81 of 2018 addresses electronic transactions and personal data protection.";
}
else if (userMessage.includes("freedom of speech lebanon")) {
    return "Freedom of speech is guaranteed by the constitution, but restrictions exist, especially on criticism of officials and institutions.";
}
else if (userMessage.includes("environment law lebanon")) {
    return "Lebanon has environmental laws covering waste management, water protection, and air quality, but enforcement is often weak.";
}


else if (userMessage.includes("what is contract law") || userMessage.includes("contract law")) {
    return "Contract law governs the agreements made between two or more parties. It ensures that the terms of the contract are legally enforceable, and if one party fails to meet their obligations, the other party can seek legal remedy.";
}

else if (userMessage.includes("can you explain contract law")) {
    return "Contract law deals with the creation, interpretation, and enforcement of agreements between parties. It is essential to ensure that the terms of a contract are clear and legally binding.";
}

else if (userMessage.includes("how does contract law work")) {
    return "Contract law is based on the principles of mutual agreement, offer and acceptance, consideration (something of value exchanged), and intent to create legal obligations. If a contract is broken, the injured party can sue for damages or other legal remedies.";
}

else if (userMessage.includes("what are the elements of a valid contract")) {
    return "A valid contract requires an offer, acceptance, consideration, and mutual intent to be legally bound. Additionally, both parties must have the capacity to enter into the contract, and it must not involve illegal activities.";
}

else if (userMessage.includes("what happens if a contract is breached")) {
    return "If a contract is breached, the injured party can file a lawsuit for damages or specific performance (forcing the breaching party to fulfill the contract). Remedies depend on the terms of the contract and the nature of the breach.";
}

else if (userMessage.includes("how can I create a valid contract")) {
    return "To create a valid contract, ensure that there is a clear offer, acceptance, and consideration between the parties involved. It’s also important that the contract is written clearly and complies with the legal requirements of your jurisdiction.";
}

else if (userMessage.includes("can a contract be voided")) {
    return "Yes, a contract can be voided if it was made under duress, fraud, undue influence, or if it involves illegal activities. Additionally, contracts made by parties without legal capacity (e.g., minors) can also be voidable.";
}

else if (userMessage.includes("what types of contracts are there")) {
    return "There are various types of contracts, including written contracts, verbal contracts, express contracts, implied contracts, bilateral contracts, and unilateral contracts. Each type serves different purposes and comes with varying legal requirements.";
}

else if (userMessage.includes("do all contracts need to be in writing")) {
    return "Not all contracts need to be in writing, but certain types, such as those involving real estate transactions, wills, or contracts lasting longer than one year, must be written to be enforceable.";
}

else if (userMessage.includes("what should I do if someone breaches a contract")) {
    return "If someone breaches a contract, you should first attempt to resolve the issue through negotiation or mediation. If that fails, you may need to take legal action by filing a lawsuit for breach of contract.";
}



else if (userMessage.match(/\b(i am|i'm|im|my name is|this is)\s+\w+/i)) {
    return "Hello and welcome! It's a pleasure to meet you. How can we assist you today?";
}
else if (userMessage.includes("how can I apply for a visa") || userMessage.includes("apply for a visa")) {
    return "To apply for a visa, you will need to gather required documents, complete the application form, and schedule an appointment at the appropriate embassy or consulate. We can guide you through the entire process.";
}
else if (userMessage.includes("how are you") || userMessage.includes("how's it going") || userMessage.includes("how are you doing")) {
    return "I'm just a chatbot, but I'm here and ready to help! How can I assist you today?";
}



else if (userMessage.includes("how to apply for a job") || userMessage.includes("apply now") || userMessage.includes("how to become a partner")) {
    return "To apply, click on the 'Apply Now' button and submit your CV with details about your education, cases won, languages spoken, work history, and legal experience. Make sure you meet the qualifications for law-related positions.";
}

else if (userMessage.includes("what happens after I apply") || userMessage.includes("after I submit my application") || userMessage.includes("after applying") || userMessage.includes("after submitting my CV") || userMessage.includes("after i apply")) {
    return "After submitting your application, the legal administration team will review your CV. If your qualifications meet the required criteria, you will be contacted via email to proceed to the next step.";
}

else if (userMessage.includes("who reviews my CV") || userMessage.includes("who assesses my application") || userMessage.includes("who looks at my CV")) {
    return "Your CV will be reviewed by the legal administrative team. They will assess your qualifications based on your legal education, experience, and other relevant factors. If accepted, you will be notified by email.";
}

else if (userMessage.includes("will I receive an email") || userMessage.includes("email notification") || userMessage.includes("will I be contacted") || userMessage.includes("receive email") ) {
    return "Yes, once your CV is reviewed and accepted, you will receive an email with further instructions. This will include a scheduled Zoom meeting with the attorney chief and legal administrative team.";
}

else if (userMessage.includes("what happens during the zoom meeting") || userMessage.includes("zoom meeting details") || userMessage.includes("zoom interview")) {
    return "During the Zoom meeting, the attorney chief and legal administrative team will discuss your qualifications, experience, and potential fit within the firm. It's an opportunity to showcase your expertise and suitability for the role.";
}

else if (userMessage.includes("what is the exam about") || userMessage.includes("exam topics") || userMessage.includes("exam content")) {
    return "After the Zoom meeting, you'll take an exam covering various legal topics to assess your knowledge and skills. The exam is scored out of 100 points, and a score above 50 will qualify you to become a partner at the firm.";
}

else if (userMessage.includes("how long is the exam") || userMessage.includes("exam duration") || userMessage.includes("length of the exam")) {
    return "The exam will take approximately 2 hours and covers different areas of law to test your competency and practical understanding. Make sure you are well-prepared for the test.";
}

else if (userMessage.includes("what if I score less than 50") || userMessage.includes("if I score below 50") || userMessage.includes("if I fail the exam") || userMessage.includes("if I don't pass")) {
    return "If you score less than 50, you will not be qualified to become a partner. However, you can always apply again after gaining more experience or improving your skills.";
}

else if (userMessage.includes("what happens if I score more than 50") || userMessage.includes("if I score above 50") || userMessage.includes("if I pass the exam") || userMessage.includes("if I pass")) {
    return "If you score above 50, you will be considered for a partnership at the firm. We will then discuss the next steps with you and invite you to join as a legal partner, starting your journey with the firm.";
}

else if (userMessage.includes("who will conduct the zoom interview") || userMessage.includes("who will interview me") || userMessage.includes("who is the interviewer") || userMessage.includes("who will be interviewing me")) {
    return "The Zoom interview will be conducted by the attorney chief and the legal administrative team. They will assess your legal knowledge and how well you align with the firm's values and needs.";
}

else if (userMessage.includes("how do I know if I have been accepted") || userMessage.includes("how will I know if I am accepted") || userMessage.includes("will I be notified if accepted") || userMessage.includes("if i am accepted")) {
    return "You will receive an email notification once your CV has been reviewed and accepted. After that, you will be invited for the Zoom meeting and exam. Keep an eye on your inbox for updates.";
}

else if (userMessage.includes("what is the qualification for applying") || userMessage.includes("qualifications for applying") || userMessage.includes("requirements to apply")) {
    return "You must have a law degree or relevant legal qualifications and experience to apply. Additionally, your CV should include details of cases you've won, languages spoken, and any other professional achievements in the legal field.";
}

else if (userMessage.includes("can I apply without legal experience") || userMessage.includes("no legal experience") || userMessage.includes("no law degree")) {
    return "Unfortunately, only applicants with legal experience will be considered for the partnership track. However, if you have relevant educational qualifications and are willing to gain more experience, you may still apply.";
}

else if (userMessage.includes("how do I prepare for the exam") || userMessage.includes("exam preparation") || userMessage.includes("study for the exam") || userMessage.includes("exam study tips")) {
    return "To prepare for the exam, review key areas of law such as contract law, criminal law, torts, and legal procedures. Focus on practical application and real-life scenarios that could be encountered in the firm.";
}

else if (userMessage.includes("is there a deadline for applying") || userMessage.includes("application deadline") || userMessage.includes("when can I apply")) {
    return "The application period may vary. Please check the 'Apply Now' section on our website for the current deadline. We encourage you to apply as soon as possible to start the process.";
}

else if (userMessage.includes("what happens if I don't pass the exam") || userMessage.includes("exam retake") || userMessage.includes("exam failure")) {
    return "If you don't pass the exam, you may be invited to reapply at a later date. The exam is designed to assess your readiness for partnership, and retaking it after further study may increase your chances.";
}

else if (userMessage.includes("what are the benefits of becoming a partner") || userMessage.includes("benefits of partnership") || userMessage.includes("partner benefits")) {
    return "As a partner, you will receive a share of the firm's profits, access to high-profile legal cases, and increased responsibilities in managing clients and the firm's operations. You will also have opportunities to lead teams and make strategic decisions.";
}
else if (userMessage.includes("how can I become a partner of the firm") || userMessage.includes("how to become a partner") || userMessage.includes("become a partner")) {
    return "To become a partner at our firm, you need to apply through the 'Apply Now' button on our website, meet the qualifications, pass an interview, and score above 50 in our legal exam. Successful applicants will then be offered a partnership.";
}

else if (userMessage.includes("what qualifications do I need to be a partner") || userMessage.includes("partnership qualifications") || userMessage.includes("partner qualifications")) {
    return "To be considered for partnership, you must have a law degree, significant legal experience, and a proven track record of success in handling legal cases. You must also meet other criteria such as fluency in languages and relevant achievements in the field of law.";
}

    else {
        return "I'm sorry, I don't understand that. Can you please rephrase?";
    }
}


    </script>

</body>
</html>
