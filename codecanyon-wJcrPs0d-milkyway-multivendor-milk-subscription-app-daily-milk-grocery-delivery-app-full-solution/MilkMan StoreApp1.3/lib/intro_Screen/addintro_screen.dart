// // ignore_for_file: camel_case_types, use_key_in_widget_constructors, annotate_overrides, prefer_const_literals_to_create_immutables, prefer_const_constructors
// import 'dart:async';

// import 'package:flutter/material.dart';
// import 'package:get/get.dart';
// import 'package:storeappnew/Bottom_bar/Bottom_bar.dart';
// import 'package:storeappnew/Login_flow/login_Screen.dart';
// import 'package:storeappnew/api_screens/data_store.dart';
// import 'package:storeappnew/utils/Colors.dart';
// import 'package:storeappnew/utils/Custom_widget.dart';

// class onbording extends StatefulWidget {
//   const onbording({Key? key}) : super(key: key);

//   @override
//   State<onbording> createState() => _onbordingState();
// }

// class _onbordingState extends State<onbording> {
//   @override
//   void initState() {
//     super.initState();

//     Timer(
//         const Duration(seconds: 3),
//         () => getData.read("Firstuser") != true
//             ? Get.to(() => BoardingPage())
//             : getData.read("Remember") != true
//                 ? Get.to(() => const Loginscreen())
//                 : Get.to(() => const BottoBarScreen()));
//   }

//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//         backgroundColor: WhiteColor,
//         body: Container(
//           decoration: BoxDecoration(
//               image: DecorationImage(
//                   image: AssetImage("assets/Splash.png"), fit: BoxFit.fill),
//               gradient: gradient.btnGradient),
//           child: Center(
//             child: Image.asset("assets/applogo.png", height: 100, width: 100),
//           ),
//         ));
//   }
// }

// class BoardingPage extends StatefulWidget {
//   @override
//   // ignore: library_private_types_in_public_api
//   _BoardingPageState createState() => _BoardingPageState();
// }

// class _BoardingPageState extends State<BoardingPage> {
//   // creating all the widget before making our home screeen
//   // SubscribeController subscribeController = Get.find();
//   // ListOfPropertiController listOfPropertiController = Get.find();

//   void initState() {
//     // getdarkmodepreviousstate();
//     super.initState();

//     _currentPage = 0;

//     _slides = [
//       Slide("assets/addintro1.png", "Offers a wide range of medical products",
//           "Including prescription drugs, medical supplies, and healthcare equipment."),
//       Slide("assets/addintro2.png", "Empowering your tomorrow, today",
//           "Market and encourages customers to try it out for themselves"),
//       Slide("assets/addintro3.png", "Innovation meets tradition",
//           "Product or service being offered combines the best of both worlds"),
//     ];
//     _pageController = PageController(initialPage: _currentPage);
//     super.initState();
//   }

//   int _currentPage = 0;
//   List<Slide> _slides = [];
//   PageController _pageController = PageController();

//   // the list which contain the build slides
//   List<Widget> _buildSlides() {
//     return _slides.map(_buildSlide).toList();
//   }

//   // late ColorNotifire notifire;

//   Widget _buildSlide(Slide slide) {
//     // notifire = Provider.of<ColorNotifire>(context, listen: true);
//     return Scaffold(
//       body: Column(
//         children: <Widget>[
//           SizedBox(
//               height: MediaQuery.of(context).size.height *
//                   0.07), //upar thi jagiya mukeli che
//           // ignore: sized_box_for_whitespace
//           Container(
//             height: MediaQuery.of(context).size.height * 0.5, //imagee size
//             width: MediaQuery.of(context).size.width,
//             alignment: Alignment.topRight,
//             child: Image.asset(
//               slide.image,
//               fit: BoxFit.cover,
//             ),
//             // color: BlackColor,
//           ),
//           SizedBox(
//             height: MediaQuery.of(context).size.height * 0.07,
//           ),
//           SizedBox(
//             width: Get.width * 0.7,
//             child: Text(
//               slide.heading,
//               textAlign: TextAlign.center,
//               style: TextStyle(
//                   fontSize: 24,
//                   fontFamily: "Gilroy Bold",
//                   color: BlackColor), //heding Text
//             ),
//           ),
//           SizedBox(height: MediaQuery.of(context).size.height * 0.02),
//           Text(
//             slide.subtext,
//             textAlign: TextAlign.center,
//             style: TextStyle(
//                 fontSize: 15,
//                 color: greyColor,
//                 fontFamily: "Gilroy Medium"), //subtext
//           ),
//         ],
//       ),
//     );
//   }

//   // handling the on page changed
//   void _handlingOnPageChanged(int page) {
//     setState(() => _currentPage = page);
//   }

//   // building page indicator
//   Widget _buildPageIndicator() {
//     Row row = Row(mainAxisAlignment: MainAxisAlignment.center, children: []);
//     for (int i = 0; i < _slides.length; i++) {
//       row.children.add(_buildPageIndicatorItem(i));
//       if (i != _slides.length - 1)
//         // ignore: curly_braces_in_flow_control_structures
//         row.children.add(
//           const SizedBox(
//             width: 10,
//           ),
//         );
//     }
//     return row;
//   }

//   Widget _buildPageIndicatorItem(int index) {
//     return Container(
//       padding: EdgeInsets.all(2),
//       width: index == _currentPage ? 14 : 12,
//       height: index == _currentPage ? 14 : 12,
//       decoration: BoxDecoration(
//         shape: BoxShape.circle,
//         border: Border.all(
//             color: index == _currentPage
//                 ? Color(0xff042628)
//                 : greyColor.withOpacity(0.8)),
//       ),
//       child: Container(
//         width: index == _currentPage ? 14 : 10,
//         height: index == _currentPage ? 14 : 10,
//         decoration: BoxDecoration(
//             shape: BoxShape.circle,
//             color: index == _currentPage
//                 ? Color(0xff042628)
//                 : greyColor.withOpacity(0.8)),
//       ),
//     );
//   }

//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       backgroundColor: WhiteColor,
//       body: Stack(
//         children: <Widget>[
//           PageView(
//             controller: _pageController,
//             onPageChanged: _handlingOnPageChanged,
//             physics: const BouncingScrollPhysics(),
//             children: _buildSlides(),
//           ),
//           Positioned(
//             left: 0,
//             right: 0,
//             bottom: 0,
//             child: Column(
//               children: <Widget>[
//                 _buildPageIndicator(),
//                 SizedBox(
//                   height: MediaQuery.of(context).size.height *
//                       0.33, //indicator set screen
//                 ),
//                 _currentPage == 2
//                     ? GestureDetector(
//                         onTap: () {
//                           Get.to(() => const Loginscreen());
//                           // listOfPropertiController.getPropertiList();
//                           // subscribeController.getSubscribeDetailsList();
//                         },
//                         child: Container(
//                           margin: const EdgeInsets.symmetric(horizontal: 15),
//                           decoration: BoxDecoration(
//                               gradient: gradient.btnGradient,
//                               borderRadius: BorderRadius.circular(15)),
//                           height: 50,
//                           width: double.infinity,
//                           child: Center(
//                             child: Text(
//                               "Get Started".tr,
//                               style: TextStyle(
//                                   fontSize: 16,
//                                   color: WhiteColor,
//                                   fontFamily: "Gilroy Bold"),
//                             ),
//                           ),
//                         ),
//                       )
//                     : GestureDetector(
//                         onTap: () {
//                           _pageController.nextPage(
//                               duration: const Duration(microseconds: 300),
//                               curve: Curves.easeIn);
//                         },
//                         child: Container(
//                           margin: const EdgeInsets.symmetric(horizontal: 15),
//                           decoration: BoxDecoration(
//                               gradient: gradient.btnGradient,
//                               borderRadius: BorderRadius.circular(15)),
//                           height: 50,
//                           width: double.infinity,
//                           child: Center(
//                             child: Text(
//                               "Next".tr,
//                               style: TextStyle(
//                                   fontSize: 16,
//                                   color: WhiteColor,
//                                   fontFamily: "Gilroy Bold"),
//                             ),
//                           ),
//                         ),
//                       ),
//                 SizedBox(
//                   height: MediaQuery.of(context).size.height *
//                       0.012, //indicator set screen
//                 ),
//                 // GestureDetector(
//                 //   onTap: () {},
//                 //   child: Text(
//                 //     "Skip",
//                 //     style: TextStyle(
//                 //       fontSize: 18,
//                 //       color: Darkblue,
//                 //       fontFamily: "Gilroy Bold",
//                 //     ),
//                 //   ),
//                 // ),
//                 // const SizedBox(height: 20)
//               ],
//             ),
//           )
//         ],
//       ),
//     );
//   }

// //   getdarkmodepreviousstate() async {
// //     final prefs = await SharedPreferences.getInstance();
// //     bool? previusstate = prefs.getBool("setIsDark");
// //     if (previusstate == null) {
// //       notifire.setIsDark = false;
// //     } else {
// //       notifire.setIsDark = previusstate;
// //     }
// //   }
// }

// class Slide {
//   String image;
//   String heading;
//   String subtext;

//   Slide(this.image, this.heading, this.subtext);
// }

// ignore_for_file: camel_case_types, use_key_in_widget_constructors, annotate_overrides, prefer_const_literals_to_create_immutables, file_names, unused_element, prefer_const_constructors, prefer_typing_uninitialized_variables, sort_child_properties_last, prefer_interpolation_to_compose_strings, unused_local_variable

import 'dart:async';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Bottom_bar/Bottom_bar.dart';
import 'package:storeappnew/Login_flow/login_Screen.dart';
import 'package:storeappnew/api_screens/data_store.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

// ignore: unused_import
class onbording extends StatefulWidget {
  const onbording({Key? key}) : super(key: key);

  @override
  State<onbording> createState() => _onbordingState();
}

class _onbordingState extends State<onbording> {
  @override
  void initState() {
    super.initState();

    Timer(
      const Duration(seconds: 3),
      () => getData.read("Firstuser") != true
          ? Get.to(() => BoardingPage())
          : getData.read("Remember") != true
          ? Get.to(() => const Loginscreen())
          : Get.to(() => const BottoBarScreen()),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: WhiteColor,
      body: Container(
        decoration: BoxDecoration(
          image: DecorationImage(
            image: AssetImage("assets/Splash.png"),
            fit: BoxFit.fill,
          ),
          gradient: gradient.btnGradient,
        ),
        alignment: Alignment.center,
        padding: EdgeInsets.only(top: 70),
        child: Image.asset("assets/newSplashLogo.png", height: 200, width: 180),
      ),
    );
  }
}

class BoardingPage extends StatefulWidget {
  @override
  // ignore: library_private_types_in_public_api
  _BoardingScreenState createState() => _BoardingScreenState();
}

class _BoardingScreenState extends State<BoardingPage> {
  // creating all the widget before making our home screeen

  void initState() {
    super.initState();

    _currentPage = 0;

    _slides = [
      Slide(
        "assets/Onboarding1.png",
        "Farm-fresh milk delivered straight to your door",
        "Our milk subscription store app lets you enjoy the taste of farm-fresh milk without ever leaving your home",
      ),
      Slide(
        "assets/Onboarding2.png",
        "Convenient milk delivery made simple!",
        "With our milk subscription store app, getting fresh, delicious milk delivered to your doorstep has never been easier.",
      ),
      Slide(
        "assets/Onboarding3.png",
        "Let's do and get things done",
        "Tired of running to the supermarket every time you run out of milk? Our milk subscription store app is the solution you've been looking for!",
      ),
    ];
    _pageController = PageController(initialPage: _currentPage);
    super.initState();
  }

  int _currentPage = 0;
  List<Slide> _slides = [];
  PageController _pageController = PageController();

  // the list which contain the build slides
  List<Widget> _buildSlides() {
    return _slides.map(_buildSlide).toList();
  }

  Widget _buildSlide(Slide slide) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: greenColor,
      body: Column(
        children: <Widget>[
          // ignore: sized_box_for_whitespace
          Container(
            height: Get.height * 0.45, //imagee size
            width: Get.width,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: Get.size.height * 0.1),
            padding: EdgeInsets.all(10),
            child: Image.asset(slide.image, fit: BoxFit.cover),
            // decoration: BoxDecoration(
            //     image: DecorationImage(
            //         image: AssetImage(slide.image), fit: BoxFit.cover)),
          ),
        ],
      ),
    );
  }

  // handling the on page changed
  void _handlingOnPageChanged(int page) {
    setState(() => _currentPage = page);
  }

  // building page indicator
  Widget _buildPageIndicator() {
    Row row = Row(mainAxisAlignment: MainAxisAlignment.center, children: []);
    for (int i = 0; i < _slides.length; i++) {
      row.children.add(_buildPageIndicatorItem(i));
      if (i != _slides.length - 1)
        // ignore: curly_braces_in_flow_control_structures
        row.children.add(const SizedBox(width: 10));
    }
    return row;
  }

  Widget _buildPageIndicatorItem(int index) {
    return Container(
      width: index == _currentPage ? 12 : 8,
      height: index == _currentPage ? 12 : 8,
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        color: index == _currentPage ? greenColor : greenColor.withOpacity(0.5),
      ),
    );
  }

  sliderText() {
    return Column(
      children: [
        SizedBox(height: Get.height * 0.05),
        SizedBox(
          width: Get.width * 0.70,
          child: Text(
            _currentPage == 0
                ? "Farm-fresh milk delivered straight to your door".tr
                : _currentPage == 1
                ? "Convenient milk delivery made simple!".tr
                : _currentPage == 2
                ? "Let's do and get things done".tr
                : "",
            textAlign: TextAlign.center,
            style: TextStyle(
              fontSize: 21,
              fontFamily: "Gilroy Bold",
              color: BlackColor,
            ), //heding Text
          ),
        ),
        SizedBox(height: Get.height * 0.02),
        SizedBox(
          width: Get.width * 0.70,
          child: Text(
            _currentPage == 0
                ? "Our milk subscription store app lets you enjoy the taste of farm-fresh milk without ever leaving your home"
                      .tr
                : _currentPage == 1
                ? "With our milk subscription store app, getting fresh, delicious milk delivered to your doorstep has never been easier."
                      .tr
                : _currentPage == 2
                ? "Tired of running to the supermarket every time you run out of milk? Our milk subscription store app is the solution you've been looking for!"
                      .tr
                : "",
            textAlign: TextAlign.center,
            style: TextStyle(
              fontSize: 13,
              color: greycolor,
              fontFamily: "Gilroy Medium",
            ), //subtext
          ),
        ),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: greenColor,
      body: Stack(
        children: <Widget>[
          PageView(
            controller: _pageController,
            onPageChanged: _handlingOnPageChanged,
            physics: const BouncingScrollPhysics(),
            children: _buildSlides(),
          ),
          GestureDetector(
            onTap: () {
              Get.to(Loginscreen());
            },
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 40),
              child: Align(
                alignment: Alignment.topRight,
                child: InkWell(
                  onTap: () {
                    Get.to(Loginscreen());
                  },
                  child: Container(
                    height: 40,
                    width: 80,
                    margin: EdgeInsets.symmetric(vertical: 5),
                    alignment: Alignment.center,
                    child: Text(
                      "Skip".tr,
                      style: TextStyle(
                        fontFamily: FontFamily.gilroyBold,
                        fontSize: 14,
                        color: WhiteColor,
                      ),
                    ),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(30),
                      color: Color(0xff317094),
                    ),
                  ),
                ),
              ),
            ),
          ),
          Positioned(
            left: 0,
            right: 0,
            bottom: 0,
            child: Container(
              height: Get.size.height * 0.36,
              width: Get.size.width,
              margin: EdgeInsets.all(10),
              decoration: BoxDecoration(
                color: WhiteColor,
                borderRadius: BorderRadius.circular(25),
              ),
              child: Column(
                children: <Widget>[
                  SizedBox(height: Get.size.height * 0.03),
                  _buildPageIndicator(),
                  sliderText(),
                  Spacer(),
                  _currentPage == 2
                      ? Padding(
                          padding: const EdgeInsets.symmetric(horizontal: 20),
                          child: GestureDetector(
                            onTap: () {
                              Get.to(Loginscreen());
                            },
                            child: Container(
                              decoration: BoxDecoration(
                                gradient: gradient.btnGradient,
                                borderRadius: BorderRadius.circular(15),
                              ),
                              height: 50,
                              width: double.infinity,
                              child: Center(
                                child: Text(
                                  "Get Started",
                                  style: TextStyle(
                                    fontSize: 16,
                                    color: WhiteColor,
                                    fontFamily: "Gilroy Bold",
                                  ),
                                ),
                              ),
                            ),
                          ),
                        )
                      : Padding(
                          padding: const EdgeInsets.symmetric(horizontal: 20),
                          child: GestureDetector(
                            onTap: () {
                              _pageController.nextPage(
                                duration: const Duration(microseconds: 300),
                                curve: Curves.easeIn,
                              );
                            },
                            child: Container(
                              decoration: BoxDecoration(
                                gradient: gradient.btnGradient,
                                borderRadius: BorderRadius.circular(15),
                              ),
                              height: 50,
                              width: double.infinity,
                              child: Center(
                                child: Text(
                                  "Next",
                                  style: TextStyle(
                                    fontSize: 16,
                                    color: WhiteColor,
                                    fontFamily: "Gilroy Bold",
                                  ),
                                ),
                              ),
                            ),
                          ),
                        ),
                  SizedBox(
                    height: Get.height * 0.012, //indicator set screen
                  ),
                  const SizedBox(height: 20),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}

class Slide {
  String image;
  String heading;
  String subtext;

  Slide(this.image, this.heading, this.subtext);
}
