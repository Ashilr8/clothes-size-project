<?php
$size = ""; // Initialize size variable
$budget_url = ""; // Initialize budget URL variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = $_POST['gender'];
    $chest = $_POST['chest'];
    $waist = $_POST['waist'];
    $hips = $_POST['hips'];
    $budget = $_POST['budget'];

    // Define size ranges based on gender for South African sizes
    if ($gender == "male") {
        if ($chest <= 86 && $waist <= 71 && $hips <= 91) {
            $size = "XS";
        } elseif ($chest <= 91 && $waist <= 76 && $hips <= 96) {
            $size = "S";
        } elseif ($chest <= 97 && $waist <= 81 && $hips <= 101) {
            $size = "M";
        } elseif ($chest <= 102 && $waist <= 86 && $hips <= 106) {
            $size = "L";
        } elseif ($chest <= 108 && $waist <= 91 && $hips <= 111) {
            $size = "XL";
        } elseif ($chest <= 114 && $waist <= 96 && $hips <= 116) {
            $size = "XXL";
        } else {
            $size = "XXXL";
        }
    } else { // Female sizes
        if ($chest <= 81 && $waist <= 70 && $hips <= 88) {
            $size = "XS";
        } elseif ($chest <= 89 && $waist <= 77 && $hips <= 96) {
            $size = "S";
        } elseif ($chest <= 97 && $waist <= 83 && $hips <= 104) {
            $size = "M";
        } elseif ($chest <= 102 && $waist <= 89 && $hips <= 110) {
            $size = "L";
        } elseif ($chest <= 108 && $waist <= 95 && $hips <= 116) {
            $size = "XL";
        } elseif ($chest <= 114 && $waist <= 101 && $hips <= 122) {
            $size = "XXL";
        } else {
            $size = "XXXL";
        }
    }

    // Determine budget URL based on user input
    if ($budget == "low") {
        if ($gender == "male") {
            header("Location: https://za.shein.com/RecommendSelection/Men-Clothing-sc-017172963.html?size=$size");
        } else {
            header("Location: https://za.shein.com/RecommendSelection/Women-Clothing-sc-017172961.html?size=$size");
        }
    } elseif ($budget == "average") {
        if ($gender == "male") {
            header("Location: https://www.mrp.com/en_za/mens?size=$size");
        } else {
            header("Location: https://www.mrp.com/en_za/ladies?size=$size");
        }
    } else { // high budget
        if ($gender == "male") {
            header("Location: https://www.farfetch.com/za/shopping/men/items.aspx?size=$size");
        } else {
            header("Location: https://www.farfetch.com/za/shopping/women/items.aspx?size=$size");
        }
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing Size Calculator</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff7e5f, #feb47b); /* Multi-color gradient */
            margin: 0;
            padding: 0;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 40px);
        }
        .container {
            width: 800px; /* Increased width for side-by-side layout */
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.3);
            display: flex; /* Flexbox for side-by-side layout */
        }
        .form-section, .chart-section {
            width: 50%; /* Each section takes half the width */
            padding: 20px;
        }
        h1, h2, h3 {
            color: #333;
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="number"], input[type="radio"], select {
            width: calc(100% - 12px);
            padding:10px;
            margin-bottom:15px;
            border-radius:5px;
            border:1px solid #ccc;
            transition:border-color .3s ease-in-out; /* Transition effect */
        }
        input[type="number"]:focus, input[type="radio"]:focus, select:hover{
           border-color:#007bff; /* Highlight color */
       }
       button {
           width: calc(100% -12px);
           padding :10px ;
           background-color:#007bff; /* Primary color */
           color:white ;
           border-radius :5px ;
           border:none ;
           cursor:pointer ;
           font-weight:bold ;
           transition :background-color .3s ease-in-out , transform .2s ease-in-out; /* Transition effects */
       }
       button:hover{
           background-color:#0056b3; /* Darker shade on hover */
           transform :translateY(-2px); /* Lift effect */
       }
       button :active{
           transform :translateY(0); /* Reset lift effect */
       }
       .result {
           margin-top: 20px;
           font-size: larger; /* Larger text for result */
           color: #333; /* Darker text color */
       }
       .chart-section h2, .chart-section h3 {
           margin-top: 0; /* Remove top margin for headings in chart section */
       }
       .chart-table {
           width: 100%;
           border-collapse: collapse; /* Collapse borders for cleaner look */
       }
       .chart-table th, .chart-table td {
           border: 1px solid #ccc; /* Light border for table cells */
           padding: 8px; 
           text-align: center; 
       }
       .chart-table th {
           background-color: #f2f2f2; /* Light gray background for headers */
       }
   </style>
</head>
<body>
   <div class="container">
       <div class="form-section">
           <h1>Find Your Clothing Size</h1>
           <form action="" method="post">
               
               <label for="gender">Gender:</label>
               <label for="male">Male</label>
               <input type="radio" id="male" name="gender" value="male" required>
               
               <label for="female">Female</label>
               <input type="radio" id="female" name="gender" value="female" required>
               

               <!-- Budget Selection -->
               <label for="budget">Budget:</label>
               <select id="budget" name="budget" required>
                   <option value="" disabled selected>Select your budget</option>
                   <option value="low">Low</option>
                   <option value="average">Average</option>
                   <option value="high">High</option>
               </select>

               <label for="chest">Chest Measurement (cm):</label>
               <input type="number" id="chest" name="chest" required>

               <label for="waist">Waist Measurement (cm):</label>
               <input type="number" id="waist" name="waist" required>

               <label for="hips">Hips Measurement (cm):</label>
               <input type="number" id="hips" name="hips" required>

               <button type="submit">Get Size</button>
           </form>

           <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
              <div class="result">
                  <h2>Your Recommended Size:</h2>
                  <p><?php echo htmlspecialchars($size); ?></p>
              </div>
          <?php endif; ?>
      </div>

      <!-- Size Chart Section -->
<div class="chart-section">
    <h2>Size Charts</h2>

    <!-- Women's Size Chart -->
    <h3>Women's Sizes</h3>
    <table class="chart-table">
        <thead>
            <tr>
                <th>Size</th>
                <th>Bust (cm)</th>
                <th>Waist (cm)</th>
                <th>Hips (cm)</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>XS (30)</td><td>76-81</td><td>64-70</td><td>83-88</td></tr>
            <tr><td>S (32)</td><td>82-89</td><td>71-77</td><td>89-96</td></tr>
            <tr><td>M (34)</td><td>90-97</td><td>78-83</td><td>97-104</td></tr>
            <tr><td>L (36)</td><td>98-102</td><td>84-89</td><td>105-110</td></tr>
            <tr><td>XL (38)</td><td>103-108</td><td>90-95</td><td>111-116</td></tr>
            <tr><td>XXL (40)</td><td>109-114</td><td>96-101</td><td>117-122</td></tr>
            <tr><td>XXXL (42)</td><td>115-120</td><td>102-107</td><td>123-128</td></tr>
        </tbody>
    </table>

    <!-- Men's Size Chart -->
<h3>Men's Sizes</h3>
<table class="chart-table">
  <thead>
    <tr>
      <th>Size</th>
      <th>Bust (cm)</th>
      <th>Waist (cm)</th>
      <th>Hips (cm)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>XS</td>
      <td>&le;86</td>
      <td>&le;71</td>
      <td>&le;91</td>
    </tr>
    <tr>
      <td>S</td>
      <td>&le;91</td>
      <td>&le;76</td>
      <td>&le;96</td>
    </tr>
    <tr>
      <td>M</td>
      <td>&le;97</td>
      <td>&le;81</td>
      <td>&le;101</td>
    </tr>
    <tr>
      <td>L</td>
      <td>&le;102</td>
      <td>&le;86</td>
      <td>&le;106</td>
    </tr>
    <tr>
      <td>XL</td>
      <td>&le;108</td>
      <td>&le;91</td>
      <td>&le;111</td>
    </tr>
    <tr>
      <td>XXL</td>
      <td>&le;114</td>
      <td>&le;96</td>
      <td>&le;116</td>
    </tr>
    <tr>
      <td>XXXL</td>
      <td>&gt;114</td>
      <td>N/A</td>
      <td>N/A</td>
    </tr>
  </tbody>
</table>

</div>



   </body>

   </html>

