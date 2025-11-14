// ignore_for_file: sort_child_properties_last, prefer_const_literals_to_create_immutables, prefer_const_constructors, file_names

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Add_extra_image_controller.dart';
import 'package:storeappnew/Controller_class/Extra_image_controller.dart';
import 'package:storeappnew/Dashboard_screens/Extra_image_screen/Add_Extra_images_screen.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class ExtraImagescreen extends StatefulWidget {
  const ExtraImagescreen({super.key});

  @override
  State<ExtraImagescreen> createState() => _ExtraImagescreenState();
}

class _ExtraImagescreenState extends State<ExtraImagescreen> {
  @override
  void initState() {
    super.initState();
    extraimageController.extraimage();
  }

  ExtraimageController extraimageController = Get.put(ExtraimageController());
  AddExtraimageController addExtraimageController =
      Get.put(AddExtraimageController());
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: CustomAppbar(
          onTap: () {
            Get.to(() => AddExtraimageScreen(
                  add: "Add",
                ));
          },
          title: "Extra Image"),
      body: SingleChildScrollView(
        physics: BouncingScrollPhysics(),
        child: Padding(
          padding: EdgeInsets.symmetric(horizontal: 12),
          child: Column(
            children: [
              SizedBox(height: Get.height * 0.02),
              GetBuilder<ExtraimageController>(builder: (context) {
                return extraimageController.isLoading
                    ? extraimageController.extraimages!.extralist.isNotEmpty
                        ? ListView.builder(
                            itemCount: extraimageController
                                .extraimages?.extralist.length,
                            shrinkWrap: true,
                            physics: NeverScrollableScrollPhysics(),
                            itemBuilder: (context, index) {
                              return InkWell(
                                onTap: () {
                                  addExtraimageController.getIdAndName(
                                      mid1: extraimageController
                                          .extraimages?.extralist[index].image,
                                      recId: extraimageController
                                          .extraimages?.extralist[index].id);
                                  Get.to(() => AddExtraimageScreen(
                                        add: "edit",
                                        pID: extraimageController.extraimages
                                            ?.extralist[index].medicineId,
                                        pName: extraimageController.extraimages
                                            ?.extralist[index].medicineTitle,
                                      ));
                                },
                                child: Stack(
                                  children: [
                                    Container(
                                      height: 125,
                                      width: Get.size.width,
                                      margin: EdgeInsets.all(10),
                                      child: Row(
                                        children: [
                                          Stack(
                                            children: [
                                              Container(
                                                height: 125,
                                                width: 110,
                                                margin: EdgeInsets.all(10),
                                                child: ClipRRect(
                                                  borderRadius:
                                                      BorderRadius.circular(15),
                                                  child: Image.network(
                                                    "${AppUrl.imageurl}${extraimageController.extraimages?.extralist[index].image ?? ""}",
                                                    height: 140,
                                                    fit: BoxFit.cover,
                                                  ),
                                                ),
                                                decoration: BoxDecoration(
                                                  borderRadius:
                                                      BorderRadius.circular(15),
                                                ),
                                              ),
                                            ],
                                          ),
                                          SizedBox(
                                            width: 4,
                                          ),
                                          Expanded(
                                            child: Column(
                                              crossAxisAlignment:
                                                  CrossAxisAlignment.start,
                                              children: [
                                                Row(
                                                  children: [
                                                    Expanded(
                                                      child: Padding(
                                                        padding:
                                                            EdgeInsets.only(
                                                                top: 30),
                                                        child: Text(
                                                          extraimageController
                                                                  .extraimages
                                                                  ?.extralist[
                                                                      index]
                                                                  .medicineTitle ??
                                                              "",
                                                          maxLines: 2,
                                                          style: TextStyle(
                                                            fontSize: 16,
                                                            fontFamily:
                                                                FontFamily
                                                                    .gilroyBold,
                                                            color: BlackColor,
                                                            overflow:
                                                                TextOverflow
                                                                    .ellipsis,
                                                          ),
                                                        ),
                                                      ),
                                                    ),
                                                  ],
                                                ),
                                                SizedBox(
                                                    height: Get.height * 0.015),
                                                Row(
                                                  children: [
                                                    extraimageController
                                                                .extraimages
                                                                ?.extralist[
                                                                    index]
                                                                .status ==
                                                            "0"
                                                        ? Text(
                                                            "UnPublish",
                                                            style: TextStyle(
                                                              color: greycolor,
                                                              fontFamily: FontFamily
                                                                  .gilroyMedium,
                                                            ),
                                                          )
                                                        : Text(
                                                            "Publish",
                                                            style: TextStyle(
                                                              color: greyColor,
                                                              fontFamily: FontFamily
                                                                  .gilroyMedium,
                                                            ),
                                                          ),
                                                    Padding(
                                                      padding: EdgeInsets.only(
                                                          top: 8),
                                                      child: Column(
                                                        children: [],
                                                      ),
                                                    ),
                                                    SizedBox(
                                                      width: 10,
                                                    ),
                                                  ],
                                                ),
                                                SizedBox(
                                                  height: 5,
                                                ),
                                              ],
                                            ),
                                          )
                                        ],
                                      ),
                                      decoration: BoxDecoration(
                                        border: Border.all(
                                            color: Colors.grey.shade200),
                                        color: WhiteColor,
                                        borderRadius: BorderRadius.circular(15),
                                      ),
                                    ),
                                    Positioned(
                                      top: 0,
                                      right: 0,
                                      child: InkWell(
                                          onTap: () {
                                            addExtraimageController
                                                .getIdAndName(
                                                    mid1: extraimageController
                                                        .extraimages
                                                        ?.extralist[index]
                                                        .image,
                                                    recId: extraimageController
                                                        .extraimages
                                                        ?.extralist[index]
                                                        .id);
                                            Get.to(() => AddExtraimageScreen(
                                                  add: "edit",
                                                  pID: extraimageController
                                                      .extraimages
                                                      ?.extralist[index]
                                                      .medicineId,
                                                  pName: extraimageController
                                                      .extraimages
                                                      ?.extralist[index]
                                                      .medicineTitle,
                                                ));
                                          },
                                          child: Container(
                                            height: 35,
                                            width: 35,
                                            padding: EdgeInsets.all(9),
                                            alignment: Alignment.center,
                                            child:
                                                Image.asset("assets/Edit.png"),
                                            decoration: BoxDecoration(
                                              shape: BoxShape.circle,
                                              color: greenColor,
                                            ),
                                          )),
                                    )
                                  ],
                                ),
                              );
                            },
                          )
                        : Padding(
                            padding: EdgeInsets.only(top: Get.height * 0.35),
                            child: Center(
                              child: Text(
                                "Extra image is not found",
                                style: TextStyle(
                                    color: greyColor,
                                    fontFamily: FontFamily.gilroyBold,
                                    fontSize: 16),
                              ),
                            ),
                          )
                    : SizedBox(
                        height: Get.size.height,
                        width: Get.size.width,
                        child: Center(
                          child: CircularProgressIndicator(
                            color: greenColor,
                          ),
                        ),
                      );
              })
            ],
          ),
        ),
      ),
    );
  }
}
