// ignore_for_file: prefer_const_constructors, non_constant_identifier_names, sort_child_properties_last, avoid_print, must_be_immutable, file_names, unrelated_type_equality_checks, unnecessary_brace_in_string_interps

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Addrider_controller.dart';
import 'package:storeappnew/Controller_class/Assign_rider_controller.dart';
import 'package:storeappnew/Controller_class/Sub_Completed_order_controller.dart';
import 'package:storeappnew/Controller_class/Subscription_details_conteroller.dart';
import 'package:storeappnew/Controller_class/Subscription_history_controller.dart';
import 'package:storeappnew/Controller_class/Rider_controller.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class PrescriptiondetailsScreen extends StatefulWidget {
  String? ordertype;
  String? oid;
  String? bottombar;
  PrescriptiondetailsScreen(
      {this.ordertype, this.oid, this.bottombar, super.key});

  @override
  State<PrescriptiondetailsScreen> createState() =>
      _PrescriptiondetailsScreenState();
}

class _PrescriptiondetailsScreenState extends State<PrescriptiondetailsScreen> {
  RiderlistController riderlistController = Get.put(RiderlistController());
  PrescriptionhistoryController prescriptionhistoryController =
      Get.put(PrescriptionhistoryController());
  AddRiderController addRiderController = Get.put(AddRiderController());
  PrescriptiondetailsController prescriptiondetailsController =
      Get.put(PrescriptiondetailsController());
  AssignriderController assignriderController =
      Get.put(AssignriderController());
  PrecompletedorderController precompletedorderController =
      Get.put(PrecompletedorderController());
  bool usercontect = false;
  bool usercontect1 = false;
  String? slectStatus;
  @override
  void initState() {
    super.initState();
    print("<><><><><><><>><><><><><><><><><><>${widget.oid}");
    riderlistController.riderlist();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: bgcolor,
      bottomNavigationBar:
          GetBuilder<PrescriptionhistoryController>(builder: (context) {
        return prescriptionhistoryController.prescriptiondetailsinfo
                        ?.orderProductList.orderStatus !=
                    "Completed" &&
                prescriptionhistoryController.prescriptiondetailsinfo
                        ?.orderProductList.orderStatus !=
                    "Cancelled"
            ? Container(
                height: Get.height * 0.09,
                child: Padding(
                  padding: EdgeInsets.symmetric(horizontal: 12, vertical: 12),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Row(
                            children: [
                              Text(
                                  "$currency${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderTotal ?? ""}",
                                  style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      color: BlackColor,
                                      fontSize: 18)),
                              SizedBox(width: Get.width * 0.02),
                              Image.asset("assets/downarrow.png",
                                  height: 14, width: 14)
                            ],
                          ),
                          SizedBox(height: Get.height * 0.005),
                          Text("Total",
                              style: TextStyle(
                                  fontFamily: FontFamily.gilroyMedium,
                                  color: greyColor,
                                  fontSize: 16)),
                        ],
                      ),
                      prescriptionhistoryController.prescriptiondetailsinfo
                                  ?.orderProductList.flowId ==
                              "0"
                          ? InkWell(
                              onTap: () {
                                prescriptiondetailsController
                                    .prescriptiondecision(oid: widget.oid);
                              },
                              child: Container(
                                height: 50,
                                width: Get.width * 0.45,
                                alignment: Alignment.center,
                                decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(12),
                                    gradient: gradient.btnGradient),
                                child: Text(
                                  "Accept",
                                  style: TextStyle(
                                    fontFamily: FontFamily.gilroyBold,
                                    color: WhiteColor,
                                    fontSize: 16,
                                  ),
                                ),
                              ),
                            )
                          : prescriptionhistoryController
                                      .prescriptiondetailsinfo
                                      ?.orderProductList
                                      .flowId ==
                                  "1"
                              ? InkWell(
                                  onTap: () {
                                    bottomsheet();
                                  },
                                  child: Container(
                                    height: 50,
                                    width: Get.width * 0.45,
                                    alignment: Alignment.center,
                                    decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(12),
                                        gradient: gradient.btnGradient),
                                    child: Text(
                                      "Assign",
                                      style: TextStyle(
                                        fontFamily: FontFamily.gilroyBold,
                                        color: WhiteColor,
                                        fontSize: 16,
                                      ),
                                    ),
                                  ),
                                )
                              : prescriptionhistoryController
                                          .prescriptiondetailsinfo
                                          ?.orderProductList
                                          .flowId ==
                                      "3"
                                  ? Container(
                                      height: 50,
                                      width: Get.width * 0.45,
                                      alignment: Alignment.center,
                                      decoration: BoxDecoration(
                                          borderRadius:
                                              BorderRadius.circular(12),
                                          gradient: gradient.btnGradient),
                                      child: Text(
                                        "Assigned",
                                        style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            color: WhiteColor,
                                            fontSize: 16),
                                      ),
                                    )
                                  : prescriptionhistoryController
                                              .prescriptiondetailsinfo
                                              ?.orderProductList
                                              .flowId ==
                                          "5"
                                      ? InkWell(
                                          child: InkWell(
                                            onTap: () {
                                              prescriptionhistoryController
                                                  .prescriptidetailslist(
                                                      oid: widget.oid);
                                              bottomsheet();
                                            },
                                            child: Container(
                                              height: 50,
                                              width: Get.width * 0.45,
                                              alignment: Alignment.center,
                                              decoration: BoxDecoration(
                                                  borderRadius:
                                                      BorderRadius.circular(12),
                                                  gradient:
                                                      gradient.btnGradient),
                                              child: Text(
                                                "Reassign",
                                                style: TextStyle(
                                                    fontFamily:
                                                        FontFamily.gilroyBold,
                                                    color: WhiteColor,
                                                    fontSize: 16),
                                              ),
                                            ),
                                          ),
                                        )
                                      : prescriptionhistoryController
                                                  .prescriptiondetailsinfo
                                                  ?.orderProductList
                                                  .flowId ==
                                              "4"
                                          ? InkWell(
                                              child: InkWell(
                                                onTap: () {},
                                                child: Container(
                                                  height: 50,
                                                  width: Get.width * 0.45,
                                                  alignment: Alignment.center,
                                                  decoration: BoxDecoration(
                                                      borderRadius:
                                                          BorderRadius.circular(
                                                              12),
                                                      gradient:
                                                          gradient.btnGradient),
                                                  child: Text(
                                                    "Delivery Started",
                                                    style: TextStyle(
                                                        fontFamily: FontFamily
                                                            .gilroyBold,
                                                        color: WhiteColor,
                                                        fontSize: 16),
                                                  ),
                                                ),
                                              ),
                                            )
                                          : SizedBox()
                    ],
                  ),
                ),
                decoration: BoxDecoration(
                  color: WhiteColor,
                ),
              )
            : SizedBox();
      }),
      appBar: AppBar(
          leading: BackButton(color: BlackColor),
          title: Text(
            "Order ID: #${widget.oid}",
            style: TextStyle(
                fontFamily: FontFamily.gilroyBold,
                color: BlackColor,
                fontSize: 17),
          ),
          elevation: 0,
          backgroundColor: WhiteColor),
      body: RefreshIndicator(
        color: greenColor,
        onRefresh: () {
          return Future.delayed(
            Duration(seconds: 2),
            () {
              setState(() {
                prescriptionhistoryController.prescriptidetailslist(
                    oid: widget.oid);
              });
            },
          );
        },
        child: GetBuilder<PrescriptionhistoryController>(builder: (context) {
          return SingleChildScrollView(
            physics: BouncingScrollPhysics(),
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 12),
              child: prescriptionhistoryController.isLoading
                  ? Column(
                      children: [
                        SizedBox(height: Get.height * 0.02),
                        Container(
                          padding: EdgeInsets.symmetric(
                              horizontal: 12, vertical: 12),
                          decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(5),
                              color: WhiteColor),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Product Info".tr,
                                style: TextStyle(
                                  fontFamily: FontFamily.gilroyBold,
                                  fontSize: 14,
                                  color: greenColor,
                                ),
                              ),
                              SizedBox(
                                height: 5,
                              ),
                              SizedBox(
                                height: 120,
                                width: double.infinity,
                                child: ListView.builder(
                                  scrollDirection: Axis.horizontal,
                                  shrinkWrap: true,
                                  itemCount: prescriptionhistoryController
                                      .prescriptiondetailsinfo
                                      ?.orderProductList
                                      .orderProductData
                                      .length,
                                  padding: EdgeInsets.zero,
                                  itemBuilder: (context, index) {
                                    return InkWell(
                                      onTap: () {
                                        prescriptionhistoryController
                                            .changeIndexProductWise(
                                                index: index);
                                      },
                                      child: Container(
                                        alignment: Alignment.center,
                                        margin: EdgeInsets.all(5),
                                        child: Column(
                                          children: [
                                            Container(
                                              height: 80,
                                              width: 100,
                                              padding: EdgeInsets.all(5),
                                              alignment: Alignment.center,
                                              child: ClipRRect(
                                                borderRadius:
                                                    BorderRadius.circular(5),
                                                child: FadeInImage.assetNetwork(
                                                  placeholder:
                                                      "assets/ezgif.com-crop.gif",
                                                  placeholderCacheHeight: 80,
                                                  placeholderCacheWidth: 100,
                                                  placeholderFit: BoxFit.cover,
                                                  image:
                                                      "${AppUrl.imageurl}${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[index].productImage}",
                                                  height: 80,
                                                  width: 100,
                                                  fit: BoxFit.cover,
                                                ),
                                              ),
                                            ),
                                            SizedBox(
                                              width: 100,
                                              child: Padding(
                                                padding: EdgeInsets.symmetric(
                                                    horizontal: 2),
                                                child: Text(
                                                  "${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[index].productName}",
                                                  maxLines: 2,
                                                  textAlign: TextAlign.center,
                                                  style: TextStyle(
                                                    fontFamily:
                                                        FontFamily.gilroyBold,
                                                    color: greyColor,
                                                    overflow:
                                                        TextOverflow.ellipsis,
                                                    fontSize: 10,
                                                  ),
                                                ),
                                              ),
                                            ),
                                          ],
                                        ),
                                        decoration: BoxDecoration(
                                          border: prescriptionhistoryController
                                                      .currentIndex ==
                                                  index
                                              ? Border.all(
                                                  color: greenColor,
                                                )
                                              : Border.all(
                                                  color: Colors.grey.shade300),
                                          // color: preScriptionControllre
                                          //             .currentIndex ==
                                          //         index
                                          //     ? Color(0xffdaedfd)
                                          //     : WhiteColor,
                                          color: WhiteColor,
                                          borderRadius:
                                              BorderRadius.circular(7),
                                        ),
                                      ),
                                    );
                                  },
                                ),
                              ),
                            ],
                          ),
                        ),
                        SizedBox(height: Get.size.height * 0.02),
                        Container(
                          padding: EdgeInsets.symmetric(
                              horizontal: 12, vertical: 12),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Delivery Date".tr,
                                style: TextStyle(
                                  fontFamily: FontFamily.gilroyBold,
                                  fontSize: 14,
                                  color: greenColor,
                                ),
                              ),
                              SizedBox(
                                height: 60,
                                child: ListView.builder(
                                  itemCount: prescriptionhistoryController
                                      .prescriptiondetailsinfo
                                      ?.orderProductList
                                      .orderProductData[
                                          prescriptionhistoryController
                                              .currentIndex]
                                      .totaldates
                                      .length,
                                  scrollDirection: Axis.horizontal,
                                  padding: EdgeInsets.zero,
                                  itemBuilder: (context, index) {
                                    return Stack(
                                      children: [
                                        Container(
                                          height: 60,
                                          width: 50,
                                          margin: EdgeInsets.all(5),
                                          alignment: Alignment.center,
                                          padding: EdgeInsets.symmetric(
                                              horizontal: 8),
                                          child: Text(
                                            prescriptionhistoryController
                                                    .prescriptiondetailsinfo
                                                    ?.orderProductList
                                                    .orderProductData[
                                                        prescriptionhistoryController
                                                            .currentIndex]
                                                    .totaldates[index]
                                                    .formatDate ??
                                                "",
                                            textAlign: TextAlign.center,
                                            style: TextStyle(
                                              fontFamily:
                                                  FontFamily.gilroyMedium,
                                              fontSize: 12,
                                              color: Colors.grey,
                                              height: 1.2,
                                              letterSpacing: 1,
                                            ),
                                          ),
                                          decoration: BoxDecoration(
                                            borderRadius:
                                                BorderRadius.circular(7),
                                            border: prescriptionhistoryController
                                                        .prescriptiondetailsinfo
                                                        ?.orderProductList
                                                        .orderProductData[
                                                            prescriptionhistoryController
                                                                .currentIndex]
                                                        .totaldates[index]
                                                        .isComplete ==
                                                    false
                                                ? Border.all(
                                                    color: Colors.grey.shade300)
                                                : Border.all(color: greenColor),
                                          ),
                                        ),
                                        prescriptionhistoryController
                                                    .prescriptiondetailsinfo
                                                    ?.orderProductList
                                                    .orderProductData[
                                                        prescriptionhistoryController
                                                            .currentIndex]
                                                    .totaldates[index]
                                                    .isComplete ==
                                                true
                                            ? Positioned(
                                                right: 0,
                                                child: Container(
                                                  height: 20,
                                                  width: 20,
                                                  padding: EdgeInsets.all(1),
                                                  alignment: Alignment.center,
                                                  child: Image.asset(
                                                    "assets/double-check.png",
                                                    color: WhiteColor,
                                                    height: 15,
                                                    width: 15,
                                                  ),
                                                  decoration: BoxDecoration(
                                                    shape: BoxShape.circle,
                                                    color: greenColor,
                                                  ),
                                                ),
                                              )
                                            : SizedBox(),
                                      ],
                                    );
                                  },
                                ),
                              )
                            ],
                          ),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(5),
                            color: WhiteColor,
                          ),
                        ),
                        SizedBox(height: Get.size.height * 0.02),
                        Container(
                          padding: EdgeInsets.symmetric(
                              horizontal: 12, vertical: 12),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Item Info".tr,
                                style: TextStyle(
                                  fontFamily: FontFamily.gilroyBold,
                                  fontSize: 14,
                                  color: greenColor,
                                ),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.start,
                                      children: [
                                        Text(
                                          "Price".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${currency}${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[prescriptionhistoryController.currentIndex].productPrice}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          "Total".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${currency}${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[prescriptionhistoryController.currentIndex].productTotal}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.start,
                                      children: [
                                        Text(
                                          "Variation".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[prescriptionhistoryController.currentIndex].productVariation}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          "Qty".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[prescriptionhistoryController.currentIndex].productQuantity}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.start,
                                      children: [
                                        Text(
                                          "Start Date".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[prescriptionhistoryController.currentIndex].startdate.toString().split(" ").first}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          "Total Delivery".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[prescriptionhistoryController.currentIndex].totaldelivery}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              OrderInfo(
                                title: "Delivery time".tr,
                                subtitle:
                                    "${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderProductData[prescriptionhistoryController.currentIndex].deliveryTimeslot}",
                              )
                            ],
                          ),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(5),
                            color: WhiteColor,
                          ),
                        ),
                        SizedBox(height: Get.height * 0.02),
                        Container(
                          padding: EdgeInsets.symmetric(
                              horizontal: 12, vertical: 12),
                          width: Get.size.width,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Order Info".tr,
                                style: TextStyle(
                                  fontFamily: FontFamily.gilroyBold,
                                  fontSize: 14,
                                  color: greenColor,
                                ),
                              ),
                              SizedBox(
                                height: 13,
                              ),
                              OrderInfo(
                                title: "Subtotal".tr,
                                subtitle:
                                    "${currency}${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderSubTotal}",
                              ),
                              SizedBox(
                                height: 13,
                              ),
                              OrderInfo(
                                title: "Delivery Charge".tr,
                                subtitle:
                                    "${currency}${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.deliveryCharge}",
                              ),
                              SizedBox(
                                height: 13,
                              ),
                              OrderInfo(
                                title: "Store Charge".tr,
                                subtitle:
                                    "${currency}${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.storeCharge}",
                              ),
                              prescriptionhistoryController
                                          .prescriptiondetailsinfo
                                          ?.orderProductList
                                          .couponAmount !=
                                      "0"
                                  ? SizedBox(
                                      height: 13,
                                    )
                                  : SizedBox(),
                              prescriptionhistoryController
                                          .prescriptiondetailsinfo
                                          ?.orderProductList
                                          .couponAmount !=
                                      "0"
                                  ? OrderInfo(
                                      title: "Coupon Amount".tr,
                                      subtitle:
                                          "${currency}${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.couponAmount}",
                                    )
                                  : SizedBox(),
                              SizedBox(
                                height: 13,
                              ),
                              OrderInfo(
                                title: "Total".tr,
                                subtitle:
                                    "${currency}${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderTotal}",
                              ),
                              SizedBox(
                                height: 2,
                              ),
                              Row(
                                mainAxisAlignment: MainAxisAlignment.start,
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
                                  Text(
                                    "Payment Method".tr,
                                    style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      fontSize: 13,
                                      color: greyColor,
                                    ),
                                  ),
                                  SizedBox(
                                    width: 2,
                                  ),
                                  Text(
                                    ":",
                                    style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      fontSize: 13,
                                      color: greyColor,
                                    ),
                                  ),
                                  SizedBox(
                                    width: 5,
                                  ),
                                  SizedBox(
                                    width: Get.size.width * 0.45,
                                    height: 35,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          prescriptionhistoryController
                                                  .prescriptiondetailsinfo
                                                  ?.orderProductList
                                                  .pMethodName ??
                                              "",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        ),
                                        Text(
                                          "(${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.orderTransactionId})",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Row(
                                mainAxisAlignment: MainAxisAlignment.start,
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
                                  Text(
                                    "Address".tr,
                                    style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      fontSize: 13,
                                      color: greyColor,
                                    ),
                                  ),
                                  SizedBox(
                                    width: 2,
                                  ),
                                  Text(
                                    ":",
                                    style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      fontSize: 13,
                                      color: greyColor,
                                    ),
                                  ),
                                  SizedBox(
                                    width: 5,
                                  ),
                                  SizedBox(
                                    width: Get.size.width * 0.72,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          prescriptionhistoryController
                                                  .prescriptiondetailsinfo
                                                  ?.orderProductList
                                                  .customerAddress ??
                                              "",
                                          maxLines: 3,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                            overflow: TextOverflow.ellipsis,
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              prescriptionhistoryController
                                          .prescriptiondetailsinfo
                                          ?.orderProductList ==
                                      "Cancelled"
                                  ? OrderInfo(
                                      title: "Cancel Comment".tr,
                                      subtitle:
                                          "${prescriptionhistoryController.prescriptiondetailsinfo?.orderProductList.commentReject}",
                                    )
                                  : SizedBox(),
                            ],
                          ),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(5),
                            color: WhiteColor,
                          ),
                        ),
                        SizedBox(height: Get.height * 0.02),
                        prescriptionhistoryController.prescriptiondetailsinfo
                                    ?.orderProductList.additionalNote !=
                                ""
                            ? Container(
                                padding: EdgeInsets.symmetric(
                                    horizontal: 12, vertical: 12),
                                width: Get.size.width,
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      "Addition Note".tr,
                                      style: TextStyle(
                                        fontFamily: FontFamily.gilroyBold,
                                        color: gradient.defoultColor,
                                        fontSize: 14,
                                      ),
                                    ),
                                    SizedBox(
                                      height: 10,
                                    ),
                                    Text(
                                      prescriptionhistoryController
                                              .prescriptiondetailsinfo
                                              ?.orderProductList
                                              .additionalNote ??
                                          "",
                                      style: TextStyle(
                                        fontFamily: FontFamily.gilroyBold,
                                        color: Colors.grey,
                                        fontSize: 14,
                                      ),
                                    ),
                                  ],
                                ),
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(5),
                                  color: WhiteColor,
                                ),
                              )
                            : SizedBox(),
                      ],
                    )
                  : SizedBox(
                      height: Get.height,
                      width: Get.width,
                      child: Center(
                        child: CircularProgressIndicator(
                          color: gradient.defoultColor,
                        ),
                      ),
                    ),
            ),
          );
        }),
      ),
    );
  }

  bgdecoration({Widget? child, EdgeInsetsGeometry? margin}) {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 12, vertical: 12),
      margin: margin,
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(12),
        border: Border.all(
          color: Colors.grey.shade300,
        ),
      ),
      child: child,
    );
  }

  bottomsheet() {
    return showModalBottomSheet(
        backgroundColor: WhiteColor,
        isScrollControlled: true,
        context: context,
        shape: const RoundedRectangleBorder(
            borderRadius: BorderRadius.only(
                topLeft: Radius.circular(15), topRight: Radius.circular(15))),
        builder: (context) {
          return StatefulBuilder(
              builder: (BuildContext context, StateSetter setState) {
            return Container(
              decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(15),
                  border: Border.all(color: Colors.grey.shade300)),
              padding: EdgeInsets.symmetric(horizontal: 12, vertical: 12),
              height: Get.height * 0.25,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text("Delivery Boy List",
                      style: TextStyle(
                          fontFamily: FontFamily.gilroyMedium,
                          color: greyColor,
                          fontSize: 16)),
                  SizedBox(height: Get.height * 0.015),
                  Container(
                    height: 60,
                    width: Get.size.width,
                    alignment: Alignment.center,
                    padding: EdgeInsets.only(left: 15, right: 15),
                    child: DropdownButton(
                      value: slectStatus,
                      hint: Text("Select assign dilevry boy"),
                      icon: Image.asset(
                        'assets/Arrowdown.png',
                        height: 20,
                        width: 20,
                      ),
                      isExpanded: true,
                      underline: SizedBox.shrink(),
                      items: riderlistController.ridertitle
                          .map<DropdownMenuItem<String>>((String value) {
                        return DropdownMenuItem<String>(
                          value: value,
                          child: Text(
                            value,
                            style: TextStyle(
                              fontFamily: FontFamily.gilroyMedium,
                              color: BlackColor,
                              fontSize: 14,
                            ),
                          ),
                        );
                      }).toList(),
                      onChanged: (value) {
                        for (var i = 0;
                            i < riderlistController.riderinfo!.riderdata.length;
                            i++) {
                          if (value ==
                              riderlistController
                                  .riderinfo?.riderdata[i].title) {
                            addRiderController.pType = riderlistController
                                    .riderinfo?.riderdata[i].id ??
                                "";
                          }
                        }
                        // if (value == "Publish") {
                        //   addmedicineController.status = "1";
                        // } else if (value == "UnPublish") {
                        //   addmedicineController.status = "0";
                        // }
                        setState(() {
                          slectStatus = value ?? "";
                          // listOfUser.add(selectValue);
                        });
                      },
                    ),
                    decoration: BoxDecoration(
                      color: WhiteColor,
                      borderRadius: BorderRadius.circular(15),
                      border: Border.all(color: Colors.grey),
                    ),
                  ),
                  SizedBox(height: Get.height * 0.03),
                  AppButton(
                    buttontext: "Assign to delivery boy",
                    onTap: () {
                      Get.back();
                      precompletedorderController.preassign(
                          orderid: widget.oid,
                          riderid: addRiderController.pType);
                    },
                  )
                ],
              ),
            );
          });
        });
  }

  OrderInfo({String? title, subtitle}) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.start,
      children: [
        Text(
          title ?? "",
          style: TextStyle(
            fontFamily: FontFamily.gilroyBold,
            fontSize: 13,
            color: greyColor,
          ),
        ),
        SizedBox(
          width: 2,
        ),
        Text(
          ":",
          style: TextStyle(
            fontFamily: FontFamily.gilroyBold,
            fontSize: 13,
            color: greyColor,
          ),
        ),
        SizedBox(
          width: 5,
        ),
        Text(
          subtitle ?? "",
          style: TextStyle(
            fontFamily: FontFamily.gilroyBold,
            fontSize: 14,
            color: Colors.grey,
          ),
        )
      ],
    );
  }

  Paymentinfo({String? text, infotext}) {
    return Column(
      children: [
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(text!,
                style: TextStyle(
                    fontFamily: FontFamily.gilroyMedium,
                    color: greyColor.withOpacity(0.8),
                    fontSize: 15)),
            Text(infotext,
                style: TextStyle(
                    fontFamily: FontFamily.gilroyBold,
                    color: BlackColor,
                    fontSize: 15)),
          ],
        ),
        SizedBox(height: Get.height * 0.015),
      ],
    );
  }
}
