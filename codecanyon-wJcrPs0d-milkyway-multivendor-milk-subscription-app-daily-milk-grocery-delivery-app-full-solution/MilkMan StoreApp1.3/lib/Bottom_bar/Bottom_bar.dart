// ignore_for_file: unused_field, library_private_types_in_public_api, camel_case_types, unused_import, prefer_const_constructors, file_names

import 'dart:developer';

import 'package:flutter/material.dart';
import 'package:storeappnew/Dashboard_screens/subscription_screen/subscription__history_screen.dart';
import 'package:storeappnew/Bottom_bar/Profile_Screen.dart';
import 'package:storeappnew/Dashboard_screens/Dashboard.dart';
import 'package:storeappnew/Dashboard_screens/Normal_order_screen/Normal_order_screen.dart';
import 'package:storeappnew/utils/Colors.dart';

int selectedIndex = 0;

class BottoBarScreen extends StatefulWidget {
  const BottoBarScreen({Key? key}) : super(key: key);

  @override
  _BottoBarScreenState createState() => _BottoBarScreenState();
}

class _BottoBarScreenState extends State<BottoBarScreen>
    with TickerProviderStateMixin {
  late int _lastTimeBackButtonWasTapped;
  static const exitTimeInMillis = 2000;

  late TabController tabController;

  @override
  void initState() {
    super.initState();
    tabController = TabController(length: 4, vsync: this);
  }

  List<Widget> myChilders = [
    Dashboard(),
    NormalorderScreen(),
    PrescriptionOrder(),
    ProfileScreen(),
  ];
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      bottomNavigationBar: BottomNavigationBar(
        type: BottomNavigationBarType.fixed,
        unselectedItemColor: greyColor,
        // backgroundColor: BlackColor,
        elevation: 0,
        selectedLabelStyle: const TextStyle(
            fontFamily: 'Gilroy Bold',
            // fontWeight: FontWeight.bold,
            fontSize: 12),
        fixedColor: greenColor,
        unselectedLabelStyle: const TextStyle(
          fontFamily: 'Gilroy Medium',
        ),
        currentIndex: selectedIndex,
        landscapeLayout: BottomNavigationBarLandscapeLayout.centered,
        showSelectedLabels: true,
        showUnselectedLabels: true,
        items: [
          BottomNavigationBarItem(
              // activeIcon: Image.asset(
              //   "assets/myorder.png",
              //   height: 20,
              // ),
              icon: Image.asset("assets/dashboard.png",
                  color: selectedIndex == 0 ? greenColor : greycolor,
                  height: MediaQuery.of(context).size.height / 40),
              label: 'Dashboard'),
          BottomNavigationBarItem(
              icon: Image.asset("assets/myorder.png",
                  color: selectedIndex == 1 ? greenColor : greycolor,
                  height: MediaQuery.of(context).size.height / 37),
              label: 'My Order'),
          BottomNavigationBarItem(
              icon: Image.asset("assets/Prescription.png",
                  color: selectedIndex == 2 ? greenColor : greycolor,
                  height: MediaQuery.of(context).size.height / 35),
              label: 'Subscription'),
          // BottomNavigationBarItem(
          //   icon: Image.asset("assets/messages.png",
          //       color: selectedIndex == 3 ? greenColor : greycolor,
          //       height: MediaQuery.of(context).size.height / 35),
          //   label: 'Chat',
          // ),
          BottomNavigationBarItem(
            icon: Image.asset("assets/Profile.png",
                color: selectedIndex == 3 ? greenColor : greycolor,
                height: MediaQuery.of(context).size.height / 35),
            label: 'Profile',
          ),
        ],
        onTap: (index) {
          setState(() {});
          selectedIndex = index;
        },
      ),
      body: myChilders[selectedIndex],
    );
  }
}
