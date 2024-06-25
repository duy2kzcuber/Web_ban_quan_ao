<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="./index.js"></script>
    <title>Tư vấn size</title>
</head>
<body>


<?php include '../headertrangchu.php';require_once 'ketnoi.php'; ?>
        <!--Day la phan tu van size-->
        <div class="cartegory-top rowe">
            <p><a href="../backend/Trangchu.php">Trang chủ</a></p><span>&#10230;</span><p>Tư vấn Size</p>
        </div>

        <div class="banner-item"> <img src="img/tuvansize.png"></div>
        <br>
        <br>
        <br>
        
        <p class="sizegiuaindam">BẢNG TƯ VẤN SIZE</p>
        <div class="tabs">
            <a onclick="showTab('size-nam',this)">NAM</a>
            <a onclick="showTab('size-nu',this)">NỮ</a>
            <a onclick="showTab('size-tre-em',this)">TRẺ EM</a>
        </div>
        


        <div id="size-nam" class="tab-content active">
            <table>
                <thead>
                    <tr>
                        <th colspan="7">SIZE ÁO</th>
                    </tr>
                    <tr>
                        <th width="10%">STT</th>
                        <th width="30%">TÊN GỌI/SIZE</th>
                        <th width="12%">S</th>
                        <th width="12%">M</th>
                        <th width="12%">L</th>
                        <th width="12%">XL</th>
                        <th width="12%">XXL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Vai</td>
                        <td>36</td>
                        <td>37</td>
                        <td>38</td>
                        <td>39</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ngực</td>
                        <td>82</td>
                        <td>86</td>
                        <td>90</td>
                        <td>94</td>
                        <td>98</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Eo</td>
                        <td>64</td>
                        <td>68</td>
                        <td>72</td>
                        <td>76</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Hông</td>
                        <td>88</td>
                        <td>92</td>
                        <td>96</td>
                        <td>100</td>
                        <td>104</td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <table>
                <thead>
                    <tr>
                        <th colspan="7">SIZE QUẦN</th>
                    </tr>
                    <tr>
                        <th width="10%">STT</th>
                        <th width="30%">TÊN GỌI/SIZE</th>
                        <th width="12%">S(26)</th>
                        <th width="12%">M(27)</th>
                        <th width="12%">L(28)</th>
                        <th width="12%">XL(29)</th>
                        <th width="12%">XXL(30)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Vòng Eo</td>
                        <td>64</td>
                        <td>68</td>
                        <td>72</td>
                        <td>76</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Vòng Mông</td>
                        <td>88</td>
                        <td>92</td>
                        <td>96</td>
                        <td>100</td>
                        <td>104</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Vòng Bụng</td>
                        <td>68</td>
                        <td>72</td>
                        <td>76</td>
                        <td>80</td>
                        <td>84</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Dài quần</td>
                        <td>96</td>
                        <td>97</td>
                        <td>98</td>
                        <td>99</td>
                        <td>100</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="size-nu" class="tab-content">
            <table>
                <thead>
                    <tr>
                        <th colspan="7">SIZE ÁO</th>
                    </tr>
                    <tr>
                        <th width="10%">STT</th>
                        <th width="30%">TÊN GỌI/SIZE</th>
                        <th width="12%">S</th>
                        <th width="12%">M</th>
                        <th width="12%">L</th>
                        <th width="12%">XL</th>
                        <th width="12%">XXL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Cổ</td>
                        <td>36</td>
                        <td>38</td>
                        <td>40</td>
                        <td>42</td>
                        <td>44</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Vai</td>
                        <td>44</td>
                        <td>45</td>
                        <td>46</td>
                        <td>47</td>
                        <td>48</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ngực</td>
                        <td>90</td>
                        <td>94</td>
                        <td>98</td>
                        <td>102</td>
                        <td>106</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Eo</td>
                        <td>88</td>
                        <td>92</td>
                        <td>96</td>
                        <td>100</td>
                        <td>104</td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <table>
                <thead>
                    <tr>
                        <th colspan="7">SIZE QUẦN</th>
                    </tr>
                    <tr>
                        <th width="10%">STT</th>
                        <th width="30%">TÊN GỌI/SIZE</th>
                        <th width="12%">S(29)</th>
                        <th width="12%">M(30)</th>
                        <th width="12%">L(31)</th>
                        <th width="12%">XL(32)</th>
                        <th width="12%">XXL(33)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Vòng Eo</td>
                        <td>76</td>
                        <td>80</td>
                        <td>84</td>
                        <td>86</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Vòng Mông</td>
                        <td>91</td>
                        <td>95</td>
                        <td>99</td>
                        <td>104</td>
                        <td>109</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Cân nặng (kg)</td>
                        <td>62-68</td>
                        <td>68-70</td>
                        <td>70-74</td>
                        <td>74-78</td>
                        <td>78-82</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Chiều cao (cm)</td>
                        <td>162-168</td>
                        <td>168-172</td>
                        <td>172-176</td>
                        <td>176-180</td>
                        <td>180-184</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="size-tre-em" class="tab-content">
            <table>
                <thead>
                    <tr>
                        <th colspan="7">SIZE QUẦN ÁO TRẺ EM</th>
                    </tr>
                    <tr>
                        <th width="10%">STT</th>
                        <th width="30%">CỠ / TUỔI</th>
                        <th width="10%">4-5</th>
                        <th width="10%">6-7</th>
                        <th width="10%">8-9</th>
                        <th width="10%">10-11</th>
                        <th width="10%">12-13</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>CHIỀU CAO (CM)</td>
                        <td>110</td>
                        <td>122</td>
                        <td>133</td>
                        <td>150</td>
                        <td>155</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>CÂN NẶNG (KG)</td>
                        <td>15-20</td>
                        <td>20-25</td>
                        <td>23-29</td>
                        <td>28-35</td>
                        <td>34-43</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>RỘNG VAI</td>
                        <td>29</td>
                        <td>30</td>
                        <td>31</td>
                        <td>32</td>
                        <td>33</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>VÒNG NGỰC</td>
                        <td>59</td>
                        <td>65</td>
                        <td>68</td>
                        <td>74</td>
                        <td>79</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>VÒNG BỤNG</td>
                        <td>54</td>
                        <td>59</td>
                        <td>62</td>
                        <td>65</td>
                        <td>69</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>VÒNG MÔNG</td>
                        <td>61</td>
                        <td>66</td>
                        <td>70</td>
                        <td>75</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>DÀI TAY</td>
                        <td>40</td>
                        <td>43</td>
                        <td>47</td>
                        <td>50</td>
                        <td>53</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>CHIỀU DÀI TỪ ĐŨNG ĐẾN ỐNG</td>
                        <td>42</td>
                        <td>52</td>
                        <td>59</td>
                        <td>66</td>
                        <td>72</td>
                    </tr>
                </tbody>
            </table>
        </div>










        <br>
        <br>
        <br>
        
        <hr>
        <br>
        <br>
        <br>
        <!-- phần foooter -->
        <!-- phần foooter -->
        <?php include '../footertrangchu.php'; ?>

</body>
</html>