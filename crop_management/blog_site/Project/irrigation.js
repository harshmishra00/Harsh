document.addEventListener("DOMContentLoaded", function () {
    const langToggle = document.getElementById("lang-toggle");
    const alertToggle = document.getElementById("alert-toggle");
    const cropSelect = document.getElementById("crop-select");
    const cropDetails = document.getElementById("crop-details");
  
    const translations = {
      hi: {
        "Irrigation Management Dashboard": "सिंचाई प्रबंधन डैशबोर्ड",
        "Schedule": "अनुसूची",
        "Monitoring": "निरीक्षण",
        "Analytics": "विश्लेषण",
        "Field Setup": "क्षेत्र सेटअप",
        "Support": "सहायता",
        "Crop Info": "फसल जानकारी",
        "Irrigation Scheduling": "सिंचाई अनुसूची",
        "Crop Type": "फसल प्रकार",
        "Set Time (e.g., 6 AM)": "समय निर्धारित करें (जैसे, सुबह 6 बजे)",
        "Duration (e.g., 30 mins)": "अवधि (जैसे, 30 मिनट)",
        "Save Schedule": "अनुसूची सहेजें",
        "Soil Moisture Monitoring": "मिट्टी की नमी निगरानी",
        "[Chart goes here]": "[चार्ट यहाँ आएगा]",
        "Water Usage Analytics": "जल उपयोग विश्लेषण",
        "Daily/Weekly/Monthly usage breakdown.": "दैनिक/साप्ताहिक/मासिक उपयोग विवरण।",
        "Download Report (PDF)": "रिपोर्ट डाउनलोड करें (PDF)",
        "Field & Equipment Management": "क्षेत्र और उपकरण प्रबंधन",
        "Field Name": "क्षेत्र का नाम",
        "Irrigation Method Details (e.g., Drip, Sprinkler)": "सिंचाई विधि विवरण (जैसे, ड्रिप, स्प्रिंकलर)",
        "Save Field": "क्षेत्र सहेजें",
        "Help & Support": "मदद और समर्थन",
        "Ask a question or request help...": "प्रश्न पूछें या सहायता का अनुरोध करें...",
        "Submit": "प्रस्तुत करें",
        "Community Forums | Government Guidelines | Chat Support": "सामुदायिक मंच | सरकारी दिशानिर्देश | चैट समर्थन",
        "Settings & Notifications": "सेटिंग्स और सूचनाएं",
        "Enable Alerts": "सूचनाएं सक्षम करें",
        "Hindi": "अंग्रेज़ी"
      }
    };
  
    langToggle.addEventListener("change", function () {
      const isHindi = langToggle.checked;
      const lang = isHindi ? "hi" : "en";
  
      Object.keys(translations.hi).forEach((text) => {
        const elements = Array.from(document.querySelectorAll("*")).filter(
          el => el.childNodes.length === 1 && el.textContent.trim() === text
        );
        elements.forEach((el) => {
          el.textContent = isHindi ? translations.hi[text] : text;
        });
      });
    });
  
    // Tab switching
    const tabInputs = document.querySelectorAll(".tabs input[type='radio']");
    const tabContents = document.querySelectorAll(".tab-content");
  
    tabInputs.forEach(input => {
      input.addEventListener("change", () => {
        tabContents.forEach(tab => tab.style.display = "none");
        const activeTab = document.getElementById(input.id + "-tab");
        if (activeTab) activeTab.style.display = "block";
      });
    });
  
    // Default tab
    document.querySelector("#schedule-tab").style.display = "block";
  
    // Alerts
    alertToggle.addEventListener("change", () => {
      alert(alertToggle.checked ? "Notifications enabled!" : "Notifications disabled.");
    });
  
    // Crop information
    const cropInfo = {
      wheat: {
        water: "400-600 mm total over the season",
        timing: "Water every 7–10 days depending on soil",
        soil: "Loamy soil with good drainage",
        temp: "12°C to 25°C",
        disease: "Rust, Smut, Powdery mildew"
      },
      rice: {
        water: "1200-1600 mm (needs standing water)",
        timing: "Keep fields flooded during main growth",
        soil: "Clayey, water-retaining soil",
        temp: "20°C to 35°C",
        disease: "Blast, Bacterial blight"
      },
      maize: {
        water: "500-800 mm per season",
        timing: "Irrigate during tasseling and silking stages",
        soil: "Well-drained loamy soil",
        temp: "18°C to 27°C",
        disease: "Downy mildew, Leaf blight"
      }
    };
  
    cropSelect.addEventListener("change", () => {
      const crop = cropSelect.value;
      if (cropInfo[crop]) {
        const info = cropInfo[crop];
        cropDetails.innerHTML = `
          <h3>${crop.charAt(0).toUpperCase() + crop.slice(1)}</h3>
          <p><strong>Water Requirement:</strong> ${info.water}</p>
          <p><strong>Best Time to Water:</strong> ${info.timing}</p>
          <p><strong>Soil Type:</strong> ${info.soil}</p>
          <p><strong>Ideal Temperature:</strong> ${info.temp}</p>
          <p><strong>Common Diseases:</strong> ${info.disease}</p>
        `;
      } else {
        cropDetails.innerHTML = '';
      }
    });
  });
  