
const cropDatabase = {
    rice: {
        name: "Rice",
        ph: { min: 5.5, max: 6.5 },
        nitrogen: { min: 120, optimal: 150 },
        phosphorus: { min: 25, optimal: 30 },
        potassium: { min: 120, optimal: 150 },
        organicMatter: { min: 3, optimal: 5 },
        moisture: { min: 60, optimal: 70 }
    },
    wheat: {
        name: "Wheat",
        ph: { min: 6.0, max: 7.0 },
        nitrogen: { min: 100, optimal: 120 },
        phosphorus: { min: 20, optimal: 25 },
        potassium: { min: 100, optimal: 120 },
        organicMatter: { min: 2, optimal: 4 },
        moisture: { min: 50, optimal: 60 }
    },
    cotton: {
        name: "Cotton",
        ph: { min: 6.0, max: 7.0 },
        nitrogen: { min: 90, optimal: 110 },
        phosphorus: { min: 20, optimal: 25 },
        potassium: { min: 90, optimal: 110 },
        organicMatter: { min: 2, optimal: 3 },
        moisture: { min: 45, optimal: 55 }
    },
    sugarcane: {
        name: "Sugarcane",
        ph: { min: 6.0, max: 7.5 },
        nitrogen: { min: 150, optimal: 180 },
        phosphorus: { min: 25, optimal: 30 },
        potassium: { min: 150, optimal: 180 },
        organicMatter: { min: 3, optimal: 5 },
        moisture: { min: 65, optimal: 75 }
    },
    maize: {
        name: "Maize",
        ph: { min: 5.8, max: 7.0 },
        nitrogen: { min: 140, optimal: 170 },
        phosphorus: { min: 30, optimal: 35 },
        potassium: { min: 130, optimal: 160 },
        organicMatter: { min: 2.5, optimal: 4 },
        moisture: { min: 55, optimal: 65 }
    }
};


const soilTestForm = document.getElementById('soilTestForm');
const resultsSection = document.getElementById('resultsSection');
const healthScore = document.getElementById('healthScore');
const healthStatus = document.getElementById('healthStatus');
const recommendationsList = document.getElementById('recommendationsList');
const suitableCrops = document.getElementById('suitableCrops');
const weatherAlert = document.getElementById('weatherAlert');
const recommendations = document.getElementById('recommendations');
const cropsList = document.getElementById('cropsList');
const tipsSection = document.getElementById('tipsSection');
const tipsGrid = document.getElementById('tipsGrid');
const learningModules = document.getElementById('learningModules');
const successStories = document.getElementById('successStories');
const prevStoryBtn = document.getElementById('prevStory');
const nextStoryBtn = document.getElementById('nextStory');


const soilParameters = {
    pH: { min: 0, max: 14, optimal: { min: 6, max: 7 } },
    nitrogen: { min: 0, max: 100, optimal: { min: 20, max: 40 } },
    phosphorus: { min: 0, max: 100, optimal: { min: 10, max: 30 } },
    potassium: { min: 0, max: 100, optimal: { min: 15, max: 35 } },
    organicMatter: { min: 0, max: 10, optimal: { min: 3, max: 5 } }
};


const cropRecommendations = {
    high: ['Tomatoes', 'Potatoes', 'Corn', 'Cabbage', 'Cauliflower'],
    medium: ['Wheat', 'Rice', 'Soybeans', 'Cotton', 'Sugarcane'],
    low: ['Millets', 'Barley', 'Oats', 'Rye', 'Sorghum']
};


const farmingTips = [
    {
        icon: 'fas fa-tint',
        title: 'Water Management',
        description: 'Implement drip irrigation for efficient water usage and reduced evaporation.'
    },
    {
        icon: 'fas fa-leaf',
        title: 'Organic Matter',
        description: 'Add compost and organic matter regularly to improve soil structure.'
    },
    {
        icon: 'fas fa-bug',
        title: 'Pest Control',
        description: 'Use integrated pest management techniques for sustainable farming.'
    },
    {
        icon: 'fas fa-crop',
        title: 'Crop Rotation',
        description: 'Practice crop rotation to maintain soil fertility and prevent diseases.'
    }
];


const learningModulesData = [
    {
        icon: 'fas fa-flask',
        title: 'Soil Science Basics',
        description: 'Learn fundamental concepts of soil composition and health.',
        content: 'Detailed content about soil science...'
    },
    {
        icon: 'fas fa-seedling',
        title: 'Crop Nutrition',
        description: 'Understanding nutrient requirements for different crops.',
        content: 'Detailed content about crop nutrition...'
    },
    {
        icon: 'fas fa-water',
        title: 'Water Management',
        description: 'Best practices for irrigation and water conservation.',
        content: 'Detailed content about water management...'
    }
];


// Event Listeners
soilTestForm.addEventListener('submit', handleSoilTest);

// Handle form submission
function handleSoilTest(e) {
    e.preventDefault();
    
    // Get form values
    const soilData = {
        ph: parseFloat(document.getElementById('ph').value),
        nitrogen: parseFloat(document.getElementById('nitrogen').value),
        phosphorus: parseFloat(document.getElementById('phosphorus').value),
        potassium: parseFloat(document.getElementById('potassium').value),
        organicMatter: parseFloat(document.getElementById('organic-matter').value),
        moisture: parseFloat(document.getElementById('moisture').value)
    };

    // Analyze soil health
    const analysis = analyzeSoilHealth(soilData);
    
    // Display results
    displayResults(analysis);
    
    // Show results section with animation
    resultsSection.style.display = 'block';
    resultsSection.scrollIntoView({ behavior: 'smooth' });
}

// Analyze soil health and generate recommendations
function analyzeSoilHealth(soilData) {
    const analysis = {
        score: 0,
        status: '',
        recommendations: [],
        suitableCrops: []
    };

    // Calculate health score
    let totalScore = 0;

    // pH score (20 points)
    if (soilData.ph >= 6.0 && soilData.ph <= 7.0) {
        totalScore += 20;
    } else if (soilData.ph >= 5.5 && soilData.ph <= 7.5) {
        totalScore += 15;
    } else {
        totalScore += 5;
        analysis.recommendations.push("Adjust soil pH to optimal range (6.0-7.0) using appropriate amendments.");
    }

    // Nitrogen score (20 points)
    if (soilData.nitrogen >= 120 && soilData.nitrogen <= 180) {
        totalScore += 20;
    } else if (soilData.nitrogen >= 90) {
        totalScore += 15;
    } else {
        totalScore += 5;
        analysis.recommendations.push("Increase nitrogen levels through organic fertilizers or legume cover crops.");
    }

    // Phosphorus score (20 points)
    if (soilData.phosphorus >= 25 && soilData.phosphorus <= 35) {
        totalScore += 20;
    } else if (soilData.phosphorus >= 20) {
        totalScore += 15;
    } else {
        totalScore += 5;
        analysis.recommendations.push("Add phosphorus-rich amendments like bone meal or rock phosphate.");
    }

    // Potassium score (15 points)
    if (soilData.potassium >= 120 && soilData.potassium <= 180) {
        totalScore += 15;
    } else if (soilData.potassium >= 90) {
        totalScore += 10;
    } else {
        totalScore += 5;
        analysis.recommendations.push("Supplement potassium through organic sources like wood ash or seaweed.");
    }

    // Organic matter score (15 points)
    if (soilData.organicMatter >= 3) {
        totalScore += 15;
    } else if (soilData.organicMatter >= 2) {
        totalScore += 10;
        analysis.recommendations.push("Increase organic matter by adding compost and practicing crop rotation.");
    } else {
        totalScore += 5;
        analysis.recommendations.push("Significantly improve organic matter content through intensive composting and cover cropping.");
    }

    // Moisture score (10 points)
    if (soilData.moisture >= 50 && soilData.moisture <= 70) {
        totalScore += 10;
    } else if (soilData.moisture >= 40) {
        totalScore += 5;
        analysis.recommendations.push("Optimize soil moisture through proper irrigation and mulching practices.");
    } else {
        analysis.recommendations.push("Implement water management strategies to maintain optimal soil moisture.");
    }

    analysis.score = totalScore;

    // Determine soil health status
    if (totalScore >= 90) {
        analysis.status = 'Excellent';
    } else if (totalScore >= 70) {
        analysis.status = 'Good';
    } else if (totalScore >= 50) {
        analysis.status = 'Fair';
    } else {
        analysis.status = 'Poor';
    }

    // Find suitable crops
    analysis.suitableCrops = findSuitableCrops(soilData);

    return analysis;
}

// Find suitable crops based on soil conditions
function findSuitableCrops(soilData) {
    const suitableCrops = [];

    for (const [cropId, crop] of Object.entries(cropDatabase)) {
        let issuitable = true;

        // Check pH range
        if (soilData.ph < crop.ph.min || soilData.ph > crop.ph.max) {
            issuitable = false;
        }

        // Check other parameters with some tolerance
        const tolerance = 0.8; // 80% of optimal values
        if (soilData.nitrogen < crop.nitrogen.min * tolerance ||
            soilData.phosphorus < crop.phosphorus.min * tolerance ||
            soilData.potassium < crop.potassium.min * tolerance ||
            soilData.organicMatter < crop.organicMatter.min * tolerance ||
            soilData.moisture < crop.moisture.min * tolerance) {
            issuitable = false;
        }

        if (issuitable) {
            suitableCrops.push(crop.name);
        }
    }

    return suitableCrops;
}

// Display analysis results
function displayResults(analysis) {
    // Update health score
    healthScore.textContent = analysis.score;
    healthScore.style.color = getScoreColor(analysis.score);
    
    // Update health status
    healthStatus.textContent = `Soil Health: ${analysis.status}`;
    healthStatus.style.color = getScoreColor(analysis.score);

    // Update recommendations
    recommendationsList.innerHTML = analysis.recommendations
        .map(rec => `<li>${rec}</li>`)
        .join('');

    // Update suitable crops
    suitableCrops.innerHTML = analysis.suitableCrops.length > 0
        ? analysis.suitableCrops
            .map(crop => `<div class="crop-item">${crop}</div>`)
            .join('')
        : '<p>No crops are optimally suited for current soil conditions. Please follow the recommendations to improve soil health.</p>';
}

// Get color based on score
function getScoreColor(score) {
    if (score >= 90) return '#27ae60';
    if (score >= 70) return '#2ecc71';
    if (score >= 50) return '#f1c40f';
    return '#e74c3c';
}

// Seasonal data
const seasonalData = {
    spring: {
        name: "Spring",
        months: [3, 4, 5],
        crops: ["Wheat", "Maize", "Cotton"],
        tips: [
            "Prepare soil with organic matter before planting",
            "Monitor soil temperature for optimal seed germination",
            "Plan irrigation systems for the growing season",
            "Consider crop rotation to improve soil health"
        ]
    },
    summer: {
        name: "Summer",
        months: [6, 7, 8],
        crops: ["Rice", "Cotton", "Sugarcane"],
        tips: [
            "Implement mulching to retain soil moisture",
            "Monitor for pest infestations regularly",
            "Ensure adequate irrigation during peak growth",
            "Consider shade protection for sensitive crops"
        ]
    },
    autumn: {
        name: "Autumn",
        months: [9, 10, 11],
        crops: ["Wheat", "Maize", "Cotton"],
        tips: [
            "Prepare for harvest season",
            "Plan post-harvest soil treatments",
            "Consider cover crops for soil protection",
            "Monitor soil moisture levels"
        ]
    },
    winter: {
        name: "Winter",
        months: [12, 1, 2],
        crops: ["Wheat"],
        tips: [
            "Protect soil from frost damage",
            "Plan next season's crop rotation",
            "Conduct soil testing and analysis",
            "Maintain soil organic matter levels"
        ]
    }
};

// Market trends data (simulated)
const marketTrends = {
    highDemand: [
        { crop: "Organic Rice", trend: "↑ 15%" },
        { crop: "Premium Cotton", trend: "↑ 12%" },
        { crop: "Quality Wheat", trend: "↑ 8%" }
    ],
    bestPrice: [
        { crop: "Sugarcane", price: "₹3200/quintal" },
        { crop: "Cotton", price: "₹6500/quintal" },
        { crop: "Rice", price: "₹2800/quintal" }
    ]
};

// Initialize seasonal insights
function initializeSeasonalInsights() {
    updateSeasonInfo();
    updateMarketTrends();
    initializeTipsCarousel();
}

// Update season information
function updateSeasonInfo() {
    const currentMonth = new Date().getMonth() + 1;
    let currentSeason;

    for (const [season, data] of Object.entries(seasonalData)) {
        if (data.months.includes(currentMonth)) {
            currentSeason = { ...data, season };
            break;
        }
    }

    const seasonInfo = document.getElementById('seasonInfo');
    const seasonalCrops = document.getElementById('seasonalCrops');

    seasonInfo.innerHTML = `
        <h4>${currentSeason.name} Season</h4>
        <p>Best time for planting:</p>
    `;

    seasonalCrops.innerHTML = currentSeason.crops
        .map(crop => `<span class="season-crop">${crop}</span>`)
        .join('');
}

// Update market trends
function updateMarketTrends() {
    const highDemandList = document.getElementById('highDemandCrops');
    const bestPriceList = document.getElementById('bestPriceCrops');

    highDemandList.innerHTML = marketTrends.highDemand
        .map(item => `<li>${item.crop} <span class="trend">${item.trend}</span></li>`)
        .join('');

    bestPriceList.innerHTML = marketTrends.bestPrice
        .map(item => `<li>${item.crop} <span class="price">${item.price}</span></li>`)
        .join('');
}

// Initialize tips carousel
function initializeTipsCarousel() {
    const currentMonth = new Date().getMonth() + 1;
    let currentSeason;

    for (const [season, data] of Object.entries(seasonalData)) {
        if (data.months.includes(currentMonth)) {
            currentSeason = data;
            break;
        }
    }

    const tipsCarousel = document.getElementById('seasonalTips');
    let tipsHTML = '';

    currentSeason.tips.forEach((tip, index) => {
        tipsHTML += `
            <div class="tip-item ${index === 0 ? 'active' : ''}">
                <p>${tip}</p>
            </div>
        `;
    });

    tipsCarousel.innerHTML = tipsHTML;

    // Rotate tips every 5 seconds
    let currentTip = 0;
    setInterval(() => {
        const tips = tipsCarousel.querySelectorAll('.tip-item');
        tips[currentTip].classList.remove('active');
        currentTip = (currentTip + 1) % tips.length;
        tips[currentTip].classList.add('active');
    }, 5000);
}

// Start seasonal insights when the page loads
document.addEventListener('DOMContentLoaded', () => {
    initializeSeasonalInsights();
    initializeTips();
    initializeLearningModules();
    initializeSuccessStories();
});

// Initialize Tips
function initializeTips() {
    tipsGrid.innerHTML = farmingTips.map(tip => `
        <div class="tip-card">
            <i class="${tip.icon}"></i>
            <h3>${tip.title}</h3>
            <p>${tip.description}</p>
        </div>
    `).join('');
}

// Initialize Learning Modules
function initializeLearningModules() {
    learningModules.innerHTML = learningModulesData.map(module => `
        <div class="module-card">
            <i class="${module.icon}"></i>
            <h4>${module.title}</h4>
            <p>${module.description}</p>
            <button class="module-btn" data-module="${module.title.toLowerCase().replace(/\s+/g, '-')}">
                Start Learning
            </button>
        </div>
    `).join('');

    // Add click handlers for module buttons
    document.querySelectorAll('.module-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const moduleId = btn.dataset.module;
            showModuleContent(moduleId);
        });
    });
}

// Show Module Content
function showModuleContent(moduleId) {
    const module = learningModulesData.find(m => 
        m.title.toLowerCase().replace(/\s+/g, '-') === moduleId
    );
    
    if (module) {
        // Create and show modal with module content
        const modal = document.createElement('div');
        modal.className = 'module-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h2>${module.title}</h2>
                <div class="module-content">
                    ${module.content}
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Add close handler
        modal.querySelector('.close-modal').addEventListener('click', () => {
            modal.remove();
        });
    }
}

// Initialize Success Stories
function initializeSuccessStories() {
    let currentStoryIndex = 0;
    
    function showStory(index) {
        const stories = document.querySelectorAll('.story-card');
        stories.forEach(story => story.classList.remove('active'));
        stories[index].classList.add('active');
    }
    
    
    prevStoryBtn.addEventListener('click', () => {
        currentStoryIndex = (currentStoryIndex - 1 + successStoriesData.length) % successStoriesData.length;
        showStory(currentStoryIndex);
    });
    
    nextStoryBtn.addEventListener('click', () => {
        currentStoryIndex = (currentStoryIndex + 1) % successStoriesData.length;
        showStory(currentStoryIndex);
    });
    
    
    setInterval(() => {
        currentStoryIndex = (currentStoryIndex + 1) % successStoriesData.length;
        showStory(currentStoryIndex);
    }, 5000);
}


document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
}); 