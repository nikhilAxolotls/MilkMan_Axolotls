// ignore_for_file: prefer_const_constructors, sort_child_properties_last, prefer_const_literals_to_create_immutables, file_names

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Notifivation_controller.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class NotificationScreen extends StatefulWidget {
  const NotificationScreen({super.key});

  @override
  State<NotificationScreen> createState() => _NotificationScreenState();
}

class _NotificationScreenState extends State<NotificationScreen> {
  NotificationController notificationController =
      Get.put(NotificationController());

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: WhiteColor,
      appBar: AppBar(
        backgroundColor: transparent,
        elevation: 0,
        leading: IconButton(
          onPressed: () {
            Get.back();
          },
          icon: Icon(
            Icons.arrow_back,
            color: BlackColor,
          ),
        ),
        title: Text(
          "Notification".tr,
          style: TextStyle(
            fontSize: 17,
            fontFamily: FontFamily.gilroyBold,
            color: BlackColor,
          ),
        ),
      ),
      body: GetBuilder<NotificationController>(builder: (context) {
        return Column(
          children: [
            Expanded(
              child: notificationController.isLoading
                  ? notificationController
                          .notificationInfo!.notificationData.isNotEmpty
                      ? ListView.builder(
                          itemCount: notificationController
                              .notificationInfo?.notificationData.length,
                          itemBuilder: (context, index) {
                            return Container(
                              margin: EdgeInsets.all(10),
                              child: ListTile(
                                leading: Container(
                                  height: 60,
                                  width: 60,
                                  padding: EdgeInsets.all(15),
                                  child: Image.asset(
                                    "assets/Notification.png",
                                    color: greenColor,
                                  ),
                                  decoration: BoxDecoration(
                                    shape: BoxShape.circle,
                                    color: greenColor.withOpacity(0.05),
                                  ),
                                ),
                                title: Text(
                                  notificationController.notificationInfo
                                          ?.notificationData[index].title ??
                                      "",
                                  style: TextStyle(
                                    fontSize: 17,
                                    fontFamily: FontFamily.gilroyBold,
                                    color: BlackColor,
                                  ),
                                ),
                                subtitle: Text(
                                  "${notificationController.notificationInfo?.notificationData[index].datetime ?? ""}"
                                      .toString()
                                      .split(".")
                                      .first,
                                  style: TextStyle(
                                    color: greyColor,
                                    fontFamily: FontFamily.gilroyMedium,
                                  ),
                                ),
                                // trailing: Container(
                                //   height: 30,
                                //   width: 50,
                                //   alignment: Alignment.center,
                                //   child: Text(
                                //     'New',
                                //     style: TextStyle(
                                //       fontFamily: FontFamily.gilroyMedium,
                                //       color: WhiteColor,
                                //     ),
                                //   ),
                                //   decoration: BoxDecoration(
                                //     color: blueColor,
                                //     borderRadius: BorderRadius.circular(5),
                                //   ),
                                // ),
                              ),
                              decoration: BoxDecoration(
                                color: bgcolor,
                                borderRadius: BorderRadius.circular(15),
                              ),
                            );
                          },
                        )
                      : Center(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            crossAxisAlignment: CrossAxisAlignment.center,
                            children: [
                              Padding(
                                padding: const EdgeInsets.only(left: 30),
                                child: Image.asset(
                                  "assets/bookingEmpty.png",
                                  height: 120,
                                  width: 120,
                                ),
                              ),
                              SizedBox(
                                height: 20,
                              ),
                              Text(
                                "We'll let you know when we\nget news for you"
                                    .tr,
                                textAlign: TextAlign.center,
                                style: TextStyle(
                                  color: greyColor,
                                  fontFamily: FontFamily.gilroyBold,
                                ),
                              )
                            ],
                          ),
                        )
                  : Center(
                      child: CircularProgressIndicator(
                        color: greenColor,
                      ),
                    ),
            ),
          ],
        );
      }),
    );
  }
}
