// ignore_for_file: file_names, duplicate_ignore
// ignore_for_file: prefer_const_constructors, prefer_const_literals_to_create_immutables, sort_child_properties_last, file_names, prefer_typing_uninitialized_variables, unused_local_variable, avoid_print

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Bottom_bar/Bottom_bar.dart';
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/Controller_class/Subscription_details_conteroller.dart';
import 'package:storeappnew/Controller_class/Subscription_history_controller.dart';
import 'package:storeappnew/Dashboard_screens/subscription_screen/subscription_order_info_screen.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class PrescriptionOrder extends StatefulWidget {
  const PrescriptionOrder({super.key});

  @override
  State<PrescriptionOrder> createState() => _PrescriptionOrderState();
}

class _PrescriptionOrderState extends State<PrescriptionOrder>
    with TickerProviderStateMixin {
  TabController? _tabController;
  final note = TextEditingController();
  var selectedRadioTile;
  String? rejectmsg = '';
  PrescriptionhistoryController prescriptionhistoryController =
      Get.put(PrescriptionhistoryController());
  PrescriptiondetailsController prescriptiondetailsController =
      Get.put(PrescriptiondetailsController());
  MymedicineController mymedicineController = Get.put(MymedicineController());

  @override
  void initState() {
    _tabController = TabController(length: 2, vsync: this);
    super.initState();
    prescriptionhistoryController.Prescriptionhistorylist(Status: "Current");
  }

  @override
  void dispose() {
    super.dispose();
    _tabController?.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () {
        Get.to(() => BottoBarScreen());
        return Future.value(false);
      },
      child: Scaffold(
        backgroundColor: bgcolor,
        appBar: AppBar(
          backgroundColor: WhiteColor,
          centerTitle: true,
          elevation: 0,
          leading: selectedIndex == 2
              ? SizedBox()
              : BackButton(
                  color: BlackColor,
                  onPressed: () {
                    Get.to(() => BottoBarScreen());
                  },
                ),
          title: Text(
            "Subscription Order",
            style: TextStyle(
              fontFamily: FontFamily.gilroyBold,
              fontSize: 18,
              color: BlackColor,
            ),
          ),
        ),
        body: Column(
          children: [
            SizedBox(
              height: 10,
            ),
            SizedBox(
              height: 40,
              child: Padding(
                padding: EdgeInsets.symmetric(horizontal: 10),
                child: TabBar(
                  controller: _tabController,
                  unselectedLabelColor: greyColor,
                  labelStyle: const TextStyle(
                    fontFamily: FontFamily.gilroyBold,
                    fontSize: 15,
                  ),
                  indicator: BoxDecoration(
                    borderRadius: BorderRadius.circular(
                      10.0,
                    ),
                    color: WhiteColor,
                  ),
                  labelColor: greenColor,
                  onTap: (value) {
                    if (value == 0) {
                      prescriptionhistoryController.Prescriptionhistorylist(
                          Status: "Current");
                    } else {
                      prescriptionhistoryController.Prescriptionhistorylist(
                          Status: "past");
                    }
                  },
                  tabs: [
                    Tab(
                      text: "Active".tr,
                    ),
                    Tab(
                      text: "Completed".tr,
                    ),
                  ],
                ),
              ),
            ),
            SizedBox(height: 5),
            Expanded(
              flex: 1,
              child: TabBarView(
                controller: _tabController,
                physics: NeverScrollableScrollPhysics(),
                children: [
                  currentOrder(),
                  pastOrder(),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget currentOrder() {
    return RefreshIndicator(
      color: greenColor,
      onRefresh: () {
        return Future.delayed(
          Duration(seconds: 2),
          () {
            setState(() {
              prescriptionhistoryController.Prescriptionhistorylist(
                  Status: "Current");
            });
          },
        );
      },
      child: SizedBox(
        height: Get.size.height,
        width: Get.size.width,
        child: GetBuilder<PrescriptionhistoryController>(builder: (context) {
          return prescriptionhistoryController.isLoading
              ? prescriptionhistoryController
                      .prescriptionorderinfo!.orderHistory.isNotEmpty
                  ? ListView.builder(
                      itemCount: prescriptionhistoryController
                          .prescriptionorderinfo?.orderHistory.length,
                      physics: BouncingScrollPhysics(),
                      shrinkWrap: true,
                      itemBuilder: (context, index) {
                        String currentdate =
                            "${prescriptionhistoryController.prescriptionorderinfo?.orderHistory[index].date.toString().split(" ").first}";
                        return InkWell(
                          onTap: () {
                            prescriptionhistoryController.prescriptidetailslist(
                                oid: prescriptionhistoryController
                                    .prescriptionorderinfo!
                                    .orderHistory[index]
                                    .id);
                            mymedicineController.mymedicine();

                            Get.to(() => PrescriptiondetailsScreen(
                                // ordertype: prescriptionhistoryController
                                //     .prescriptionorderinfo!
                                //     .orderHistory[index]
                                //     .orderType,
                                oid: prescriptionhistoryController
                                    .prescriptionorderinfo!
                                    .orderHistory[index]
                                    .id));
                            print(
                                "<><><><><><><>><><><><><><><><><><>${prescriptionhistoryController.prescriptionorderinfo!.orderHistory[index].id}");
                          },
                          child: Container(
                            width: Get.size.width,
                            margin: EdgeInsets.symmetric(
                                horizontal: 10, vertical: 6),
                            padding: EdgeInsets.symmetric(
                                horizontal: 10, vertical: 10),
                            decoration: BoxDecoration(
                                color: WhiteColor,
                                borderRadius: BorderRadius.circular(15)),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.center,
                              children: [
                                SizedBox(height: 10),
                                Row(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      currentdate,
                                      style: TextStyle(
                                          fontFamily: FontFamily.gilroyMedium),
                                    ),
                                    Spacer(),
                                    prescriptionhistoryController
                                                .prescriptionorderinfo
                                                ?.orderHistory[index]
                                                .status ==
                                            "Pending"
                                        ? Row(
                                            children: [
                                              Image.asset(
                                                  "assets/info-circle.png",
                                                  height: 20,
                                                  width: 20),
                                              SizedBox(width: 5),
                                              Text(
                                                prescriptionhistoryController
                                                        .prescriptionorderinfo
                                                        ?.orderHistory[index]
                                                        .status ??
                                                    "",
                                                style: TextStyle(
                                                  fontFamily:
                                                      FontFamily.gilroyBold,
                                                  color: Color(0xFFFFBB00),
                                                ),
                                              ),
                                            ],
                                          )
                                        : prescriptionhistoryController
                                                    .prescriptionorderinfo
                                                    ?.orderHistory[index]
                                                    .status ==
                                                "Processing"
                                            ? Row(
                                                children: [
                                                  Image.asset(
                                                      "assets/Processing.png",
                                                      height: 20,
                                                      width: 20),
                                                  SizedBox(width: 5),
                                                  Text(
                                                    prescriptionhistoryController
                                                            .prescriptionorderinfo
                                                            ?.orderHistory[
                                                                index]
                                                            .status ??
                                                        "",
                                                    style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      color: blueColor,
                                                    ),
                                                  ),
                                                ],
                                              )
                                            : Row(
                                                children: [
                                                  Image.asset(
                                                      "assets/OnRote.png",
                                                      height: 20,
                                                      width: 20),
                                                  SizedBox(width: 5),
                                                  Text(
                                                    prescriptionhistoryController
                                                            .prescriptionorderinfo
                                                            ?.orderHistory[
                                                                index]
                                                            .status ??
                                                        "",
                                                    style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      color: Darkblue,
                                                    ),
                                                  ),
                                                ],
                                              )
                                  ],
                                ),
                                SizedBox(height: 10),
                                Row(
                                  mainAxisAlignment:
                                      MainAxisAlignment.spaceBetween,
                                  children: [
                                    Text(
                                      "Order ID: ${prescriptionhistoryController.prescriptionorderinfo?.orderHistory[index].id ?? ""}",
                                      style: TextStyle(
                                          fontFamily: FontFamily.gilroyBold,
                                          color: BlackColor,
                                          fontSize: 16),
                                    ),
                                    // Text(
                                    //   prescriptionhistoryController
                                    //           .prescriptionorderinfo
                                    //           ?.orderHistory[index]
                                    //           .orderType ??
                                    //       "",
                                    //   style: TextStyle(
                                    //       fontFamily: FontFamily.gilroyBold,
                                    //       color: greenColor,
                                    //       fontSize: 16),
                                    // ),
                                  ],
                                ),
                                SizedBox(height: 10),
                                Row(
                                  children: [
                                    Container(
                                      height: 60,
                                      width: 60,
                                      alignment: Alignment.center,
                                      decoration: BoxDecoration(
                                        // image: DecorationImage(
                                        //   // image: NetworkImage(AppUrl.imageurl +
                                        //   //     prescriptionhistoryController
                                        //   //         .orderhistoryinfo!
                                        //   //         .orderHistory[index]
                                        //   //         .t),
                                        // ),
                                        color: bgcolor,
                                        shape: BoxShape.circle,
                                      ),
                                      child: Text(
                                        prescriptionhistoryController
                                            .prescriptionorderinfo!
                                            .orderHistory[index]
                                            .customerName[0]
                                            .toUpperCase(),
                                        style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 20,
                                            color: greenColor),
                                      ),
                                    ),
                                    Expanded(
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          Row(
                                            children: [
                                              SizedBox(width: 5),
                                              SizedBox(
                                                width: Get.width * 0.2,
                                                child: Text(
                                                  prescriptionhistoryController
                                                          .prescriptionorderinfo
                                                          ?.orderHistory[index]
                                                          .customerName ??
                                                      "",
                                                  overflow:
                                                      TextOverflow.ellipsis,
                                                  style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      fontSize: 17,
                                                      color: BlackColor),
                                                ),
                                              ),
                                              Spacer(),
                                              // Text(
                                              //   prescriptionhistoryController
                                              //           .prescriptionorderinfo
                                              //           ?.orderHistory[index]
                                              //           .paymentTitle ??
                                              //       "",
                                              //   style: TextStyle(
                                              //       fontFamily:
                                              //           FontFamily.gilroyBold,
                                              //       fontSize: 15,
                                              //       color: BlackColor),
                                              // ),
                                            ],
                                          ),
                                          SizedBox(height: 5),
                                          Row(
                                            children: [
                                              SizedBox(width: 5),
                                              SizedBox(
                                                width: Get.width * 0.4,
                                                child: Text(
                                                  prescriptionhistoryController
                                                          .prescriptionorderinfo
                                                          ?.orderHistory[index]
                                                          .customerAddress ??
                                                      "",
                                                  overflow:
                                                      TextOverflow.ellipsis,
                                                  style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      fontSize: 15,
                                                      color: BlackColor),
                                                ),
                                              ),
                                              Spacer(),
                                              Text(
                                                "$currency${prescriptionhistoryController.prescriptionorderinfo?.orderHistory[index].total ?? ""}",
                                                style: TextStyle(
                                                    fontFamily:
                                                        FontFamily.gilroyBold,
                                                    fontSize: 15,
                                                    color: greenColor),
                                              ),
                                            ],
                                          ),
                                        ],
                                      ),
                                    ),
                                  ],
                                ),
                                SizedBox(height: 10),
                                prescriptionhistoryController
                                            .prescriptionorderinfo!
                                            .orderHistory[index]
                                            .flowId ==
                                        "0"
                                    ? Row(
                                        mainAxisAlignment:
                                            MainAxisAlignment.spaceBetween,
                                        children: [
                                          orderbutton(
                                              buttoncolor: redgradient,
                                              text: "Cancle",
                                              onTap: () {
                                                ticketCancell(
                                                    prescriptionhistoryController
                                                        .prescriptionorderinfo!
                                                        .orderHistory[index]
                                                        .id);
                                                setState(() {
                                                  //   prescriptionhistoryController
                                                  //       .Prescriptionhistorylist(
                                                  //           Status: "Current");
                                                });
                                              }),
                                          orderbutton(
                                              gradient: gradient.btnGradient,
                                              text: "Info",
                                              onTap: () {
                                                prescriptionhistoryController
                                                    .prescriptidetailslist(
                                                        oid: prescriptionhistoryController
                                                            .prescriptionorderinfo!
                                                            .orderHistory[index]
                                                            .id);
                                                Get.to(() =>
                                                    PrescriptiondetailsScreen(
                                                        // ordertype:
                                                        //     prescriptionhistoryController
                                                        //         .prescriptionorderinfo!
                                                        //         .orderHistory[index]
                                                        //         .orderType,
                                                        oid: prescriptionhistoryController
                                                            .prescriptionorderinfo!
                                                            .orderHistory[index]
                                                            .id));
                                                print(
                                                    "<><><><><><><>><><><><><><><><><><>${prescriptionhistoryController.prescriptionorderinfo!.orderHistory[index].id}");
                                              }),
                                        ],
                                      )
                                    : InkWell(
                                        onTap: () {
                                          prescriptionhistoryController
                                              .prescriptidetailslist(
                                                  oid: prescriptionhistoryController
                                                      .prescriptionorderinfo!
                                                      .orderHistory[index]
                                                      .id);
                                          Get.to(
                                              () => PrescriptiondetailsScreen(
                                                    // ordertype:
                                                    //     prescriptionhistoryController
                                                    //         .prescriptionorderinfo!
                                                    //         .orderHistory[index]
                                                    //         .orderType,
                                                    oid: prescriptionhistoryController
                                                        .prescriptionorderinfo!
                                                        .orderHistory[index]
                                                        .id,
                                                  ));
                                          print(
                                              "<><><><><><><>><><><><><><><><><><>${prescriptionhistoryController.prescriptionorderinfo!.orderHistory[index].id}");
                                        },
                                        child: Container(
                                          height: 45,
                                          width: Get.width * 0.82,
                                          alignment: Alignment.center,
                                          decoration: BoxDecoration(
                                              borderRadius:
                                                  BorderRadius.circular(50),
                                              gradient: gradient.btnGradient),
                                          child: Text("Info",
                                              style: TextStyle(
                                                  color: WhiteColor,
                                                  fontFamily: "Gilroy Bold",
                                                  fontSize: 16)),
                                        ),
                                      ),
                              ],
                            ),
                          ),
                        );
                      },
                    )
                  : Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Container(
                          height: 150,
                          width: 200,
                          decoration: BoxDecoration(
                            image: DecorationImage(
                                image: AssetImage("assets/emptyOrder.png")),
                          ),
                        ),
                        SizedBox(
                          height: 10,
                        ),
                        Text(
                          "No orders placed!",
                          style: TextStyle(
                              fontFamily: FontFamily.gilroyBold,
                              color: BlackColor,
                              fontSize: 15),
                        ),
                        SizedBox(height: 5),
                        Text(
                          "Currently you don’t have any orders.",
                          style: TextStyle(
                              fontFamily: FontFamily.gilroyMedium,
                              color: greyColor),
                        ),
                      ],
                    )
              : Center(child: CircularProgressIndicator());
        }),
      ),
    );
  }

  Widget pastOrder() {
    return RefreshIndicator(
      color: greenColor,
      onRefresh: () {
        return Future.delayed(
          Duration(seconds: 2),
          () {
            setState(() {
              prescriptionhistoryController.Prescriptionhistorylist(
                  Status: "Past");
            });
          },
        );
      },
      child: SizedBox(
        height: Get.size.height,
        width: Get.size.width,
        child: GetBuilder<PrescriptionhistoryController>(builder: (context) {
          return prescriptionhistoryController.isLoading
              ? prescriptionhistoryController
                      .prescriptionorderinfo!.orderHistory.isNotEmpty
                  ? ListView.builder(
                      itemCount: prescriptionhistoryController
                          .prescriptionorderinfo?.orderHistory.length,
                      physics: BouncingScrollPhysics(),
                      shrinkWrap: true,
                      itemBuilder: (context, index) {
                        String currentdate =
                            "${prescriptionhistoryController.prescriptionorderinfo?.orderHistory[index].date.toString().split(" ").first}";
                        return InkWell(
                          onTap: () {
                            prescriptionhistoryController.prescriptidetailslist(
                                oid: prescriptionhistoryController
                                    .prescriptionorderinfo!
                                    .orderHistory[index]
                                    .id);
                            Get.to(() => PrescriptiondetailsScreen(
                                // ordertype: prescriptionhistoryController
                                //     .prescriptionorderinfo!
                                //     .orderHistory[index]
                                //     .orderType,
                                oid: prescriptionhistoryController
                                    .prescriptionorderinfo!
                                    .orderHistory[index]
                                    .id,
                                bottombar: prescriptionhistoryController
                                    .prescriptionorderinfo!
                                    .orderHistory[index]
                                    .status));
                            print(
                                "<><><><><><><>><><><><><><><><><><>${prescriptionhistoryController.prescriptionorderinfo!.orderHistory[index].id}");
                          },
                          child: Container(
                            width: Get.size.width,
                            margin: EdgeInsets.symmetric(
                                horizontal: 10, vertical: 6),
                            padding: EdgeInsets.symmetric(
                                horizontal: 10, vertical: 10),
                            decoration: BoxDecoration(
                                color: WhiteColor,
                                borderRadius: BorderRadius.circular(15)),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                SizedBox(height: 10),
                                Row(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      currentdate,
                                      style: TextStyle(
                                          fontFamily: FontFamily.gilroyMedium),
                                    ),
                                    Spacer(),
                                    prescriptionhistoryController
                                                .prescriptionorderinfo
                                                ?.orderHistory[index]
                                                .status ==
                                            "Cancelled"
                                        ? Row(
                                            children: [
                                              Image.asset(
                                                  "assets/Cancelled.png",
                                                  height: 20,
                                                  width: 20),
                                              SizedBox(width: 5),
                                              Text(
                                                prescriptionhistoryController
                                                        .prescriptionorderinfo
                                                        ?.orderHistory[index]
                                                        .status ??
                                                    "",
                                                style: TextStyle(
                                                  fontFamily:
                                                      FontFamily.gilroyBold,
                                                  color: redgradient,
                                                ),
                                              ),
                                            ],
                                          )
                                        : Row(
                                            children: [
                                              Image.asset(
                                                  "assets/Delivered.png",
                                                  height: 20,
                                                  width: 20),
                                              SizedBox(width: 5),
                                              Text(
                                                prescriptionhistoryController
                                                        .prescriptionorderinfo
                                                        ?.orderHistory[index]
                                                        .status ??
                                                    "",
                                                style: TextStyle(
                                                  fontFamily:
                                                      FontFamily.gilroyBold,
                                                  color: greenColor,
                                                ),
                                              ),
                                            ],
                                          )
                                  ],
                                ),
                                SizedBox(height: 10),
                                Row(
                                  mainAxisAlignment:
                                      MainAxisAlignment.spaceBetween,
                                  children: [
                                    Text(
                                      "Order ID: ${prescriptionhistoryController.prescriptionorderinfo?.orderHistory[index].id ?? ""}",
                                      style: TextStyle(
                                          fontFamily: FontFamily.gilroyBold,
                                          color: BlackColor,
                                          fontSize: 16),
                                    ),
                                    // Text(
                                    //   prescriptionhistoryController
                                    //           .prescriptionorderinfo
                                    //           ?.orderHistory[index]
                                    //           .orderType ??
                                    //       "",
                                    //   style: TextStyle(
                                    //       fontFamily: FontFamily.gilroyBold,
                                    //       color: greenColor,
                                    //       fontSize: 16),
                                    // ),
                                  ],
                                ),
                                SizedBox(height: 10),
                                Row(
                                  children: [
                                    Container(
                                      height: 60,
                                      width: 60,
                                      alignment: Alignment.center,
                                      decoration: BoxDecoration(
                                        color: bgcolor,
                                        shape: BoxShape.circle,
                                      ),
                                      child: Text(
                                        prescriptionhistoryController
                                            .prescriptionorderinfo!
                                            .orderHistory[index]
                                            .customerName[0],
                                        style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 20,
                                            color: BlackColor),
                                      ),
                                    ),
                                    Expanded(
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          Row(
                                            children: [
                                              SizedBox(width: 5),
                                              SizedBox(
                                                width: Get.width * 0.4,
                                                child: Text(
                                                  prescriptionhistoryController
                                                          .prescriptionorderinfo
                                                          ?.orderHistory[index]
                                                          .customerName ??
                                                      "",
                                                  overflow:
                                                      TextOverflow.ellipsis,
                                                  style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      fontSize: 15,
                                                      color: BlackColor),
                                                ),
                                              ),
                                              Spacer(),
                                              // Text(
                                              //   prescriptionhistoryController
                                              //           .prescriptionorderinfo
                                              //           ?.orderHistory[index]
                                              //           .paymentTitle ??
                                              //       "",
                                              //   style: TextStyle(
                                              //       fontFamily:
                                              //           FontFamily.gilroyBold,
                                              //       fontSize: 15,
                                              //       color: BlackColor),
                                              // ),
                                            ],
                                          ),
                                          SizedBox(height: 5),
                                          Row(
                                            children: [
                                              SizedBox(width: 5),
                                              SizedBox(
                                                width: Get.width * 0.4,
                                                child: Text(
                                                  prescriptionhistoryController
                                                          .prescriptionorderinfo
                                                          ?.orderHistory[index]
                                                          .customerAddress ??
                                                      "",
                                                  overflow:
                                                      TextOverflow.ellipsis,
                                                  style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      fontSize: 15,
                                                      color: BlackColor),
                                                ),
                                              ),
                                              Spacer(),
                                              Text(
                                                "$currency${prescriptionhistoryController.prescriptionorderinfo?.orderHistory[index].total ?? ""}",
                                                style: TextStyle(
                                                    fontFamily:
                                                        FontFamily.gilroyBold,
                                                    fontSize: 15,
                                                    color: BlackColor),
                                              ),
                                            ],
                                          ),
                                        ],
                                      ),
                                    ),
                                  ],
                                ),
                                SizedBox(height: Get.height * 0.02),
                                Row(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    InkWell(
                                      onTap: () {
                                        prescriptionhistoryController
                                            .prescriptidetailslist(
                                                oid:
                                                    prescriptionhistoryController
                                                        .prescriptionorderinfo!
                                                        .orderHistory[index]
                                                        .id);
                                        Get.to(() => PrescriptiondetailsScreen(
                                            // ordertype:
                                            //     prescriptionhistoryController
                                            //         .prescriptionorderinfo!
                                            //         .orderHistory[index]
                                            //         .orderType,
                                            oid: prescriptionhistoryController
                                                .prescriptionorderinfo!
                                                .orderHistory[index]
                                                .id,
                                            bottombar:
                                                prescriptionhistoryController
                                                    .prescriptionorderinfo!
                                                    .orderHistory[index]
                                                    .status));
                                        print(
                                            "<><><><><><><>><><><><><><><><><><>${prescriptionhistoryController.prescriptionorderinfo!.orderHistory[index].id}");
                                      },
                                      child: Container(
                                        height: 45,
                                        width: Get.width * 0.82,
                                        alignment: Alignment.center,
                                        decoration: BoxDecoration(
                                            borderRadius:
                                                BorderRadius.circular(50),
                                            gradient: gradient.btnGradient),
                                        child: Text("Info",
                                            style: TextStyle(
                                                color: WhiteColor,
                                                fontFamily: "Gilroy Bold",
                                                fontSize: 16)),
                                      ),
                                    ),
                                  ],
                                )
                              ],
                            ),
                          ),
                        );
                      },
                    )
                  : Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Container(
                          height: 150,
                          width: 200,
                          decoration: BoxDecoration(
                            image: DecorationImage(
                                image: AssetImage("assets/emptyOrder.png")),
                          ),
                        ),
                        SizedBox(
                          height: 10,
                        ),
                        Text(
                          "No orders placed!",
                          style: TextStyle(
                              fontFamily: FontFamily.gilroyBold,
                              color: BlackColor,
                              fontSize: 15),
                        ),
                        SizedBox(height: 5),
                        Text(
                          "Currently you don’t have any orders.",
                          style: TextStyle(
                              fontFamily: FontFamily.gilroyMedium,
                              color: greyColor),
                        ),
                      ],
                    )
              : Center(child: CircularProgressIndicator());
        }),
      ),
    );
  }

  ticketCancell(orderid) {
    showModalBottomSheet(
        isDismissible: false,
        isScrollControlled: true,
        backgroundColor: WhiteColor,
        shape: const RoundedRectangleBorder(
            borderRadius: BorderRadius.vertical(top: Radius.circular(24))),
        clipBehavior: Clip.antiAliasWithSaveLayer,
        context: context,
        builder: (BuildContext context) {
          return StatefulBuilder(
              builder: (BuildContext context, StateSetter setState) {
            return SingleChildScrollView(
              child: Padding(
                padding: EdgeInsets.only(
                    bottom: MediaQuery.of(context).viewInsets.bottom),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    SizedBox(height: Get.height * 0.02),
                    Container(
                        height: 6,
                        width: 80,
                        decoration: BoxDecoration(
                            color: Colors.grey.shade300,
                            borderRadius: BorderRadius.circular(25))),
                    SizedBox(height: Get.height * 0.02),
                    Text(
                      "Select Reason".tr,
                      style: TextStyle(
                          fontSize: 20,
                          fontFamily: 'Gilroy Bold',
                          color: BlackColor),
                    ),
                    SizedBox(height: Get.height * 0.02),
                    Text(
                      "Please select the reason for cancellation:".tr,
                      style: TextStyle(
                          fontSize: 16,
                          fontFamily: 'Gilroy Medium',
                          color: BlackColor),
                    ),
                    SizedBox(height: Get.height * 0.02),
                    ListView.builder(
                      itemCount: cancelList.length,
                      shrinkWrap: true,
                      physics: const NeverScrollableScrollPhysics(),
                      itemBuilder: (ctx, i) {
                        return InkWell(
                          onTap: () {
                            setState(() {});
                            selectedRadioTile = i;
                            rejectmsg = cancelList[i]["title"];
                          },
                          child: SizedBox(
                            height: 40,
                            child: Row(
                              children: [
                                SizedBox(
                                  width: 25,
                                ),
                                Radio(
                                  activeColor: gradient.defoultColor,
                                  value: i,
                                  groupValue: selectedRadioTile,
                                  onChanged: (value) {
                                    setState(() {});
                                    selectedRadioTile = value;
                                    rejectmsg = cancelList[i]["title"];
                                  },
                                ),
                                SizedBox(
                                  width: 15,
                                ),
                                Text(
                                  cancelList[i]["title"],
                                  style: TextStyle(
                                    fontSize: 16,
                                    fontFamily: 'Gilroy Medium',
                                    color: BlackColor,
                                  ),
                                ),
                              ],
                            ),
                          ),
                        );
                        // return RadioListTile(
                        //   dense: true,
                        //   value: i,
                        //   activeColor: Color(0xFF246BFD),
                        //   tileColor: BlackColor,
                        //   selected: true,
                        //   groupValue: selectedRadioTile,
                        //   title: Text(
                        //     cancelList[i]["title"],
                        //     style: TextStyle(
                        //         fontSize: 16,
                        //         fontFamily: 'Gilroy Medium',
                        //         color: BlackColor),
                        //   ),
                        //   onChanged: (val) {
                        //     setState(() {});
                        //     selectedRadioTile = val;
                        //     rejectmsg = cancelList[i]["title"];
                        //   },
                        // );
                      },
                    ),
                    rejectmsg == "Others".tr
                        ? SizedBox(
                            height: 50,
                            width: Get.width * 0.85,
                            child: TextField(
                              controller: note,
                              decoration: InputDecoration(
                                  isDense: true,
                                  enabledBorder: OutlineInputBorder(
                                    borderRadius: const BorderRadius.all(
                                        Radius.circular(10)),
                                    borderSide: BorderSide(
                                        color: Color(0xFF246BFD), width: 1),
                                  ),
                                  focusedBorder: OutlineInputBorder(
                                    borderRadius: const BorderRadius.all(
                                        Radius.circular(10)),
                                    borderSide: BorderSide(
                                        color: Color(0xFF246BFD), width: 1),
                                  ),
                                  hintText: 'Enter reason'.tr,
                                  hintStyle: TextStyle(
                                      fontFamily: 'Gilroy Medium',
                                      fontSize: Get.size.height / 55,
                                      color: Colors.grey)),
                            ),
                          )
                        : const SizedBox(),
                    SizedBox(height: Get.height * 0.02),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                      children: [
                        orderbutton(
                          text: "Cancel",
                          buttoncolor: redgradient,
                          onTap: () {
                            Get.back();
                            ApiWrapper.showToastMessage("Cancelled By You");
                          },
                        ),
                        orderbutton(
                          text: "Confirm",
                          gradient: gradient.btnGradient,
                          onTap: () {
                            Get.back();
                            prescriptiondetailsController.prescriptioncancle(
                                oid: orderid,
                                reason: rejectmsg == "Others".tr
                                    ? note.text
                                    : rejectmsg);
                          },
                        ),
                      ],
                    ),
                    SizedBox(height: Get.height * 0.04),
                  ],
                ),
              ),
            );
          });
        });
  }

  List cancelList = [
    {"id": 1, "title": "Financing fell through".tr},
    {"id": 2, "title": "Inspection issues".tr},
    {"id": 3, "title": "Change in financial situation".tr},
    {"id": 4, "title": "Title issues".tr},
    {"id": 5, "title": "Seller changes their mind".tr},
    {"id": 6, "title": "Competing offer".tr},
    {"id": 7, "title": "Personal reasons".tr},
    {"id": 8, "title": "Others".tr},
  ];
}
