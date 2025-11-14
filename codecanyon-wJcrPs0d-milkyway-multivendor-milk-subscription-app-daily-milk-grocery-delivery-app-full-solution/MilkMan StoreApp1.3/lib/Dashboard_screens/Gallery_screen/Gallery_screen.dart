// ignore_for_file: sort_child_properties_last, prefer_const_literals_to_create_immutables, prefer_const_constructors, file_names

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Add_gallery_image_controller.dart';
import 'package:storeappnew/Controller_class/Gallery_controller.dart';
import 'package:storeappnew/Dashboard_screens/Gallery_screen/Add_gallery_image_screen.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class GalleryScreen extends StatefulWidget {
  const GalleryScreen({super.key});

  @override
  State<GalleryScreen> createState() => _GalleryScreenState();
}

class _GalleryScreenState extends State<GalleryScreen> {
  @override
  void initState() {
    galleyViewController.viewgalley();
    super.initState();
  }

  GalleyViewController galleyViewController = Get.put(GalleyViewController());
  AddGalleryimageController addGalleryimageController =
      Get.put(AddGalleryimageController());
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: CustomAppbar(
          onTap: () {
            Get.to(() => AddgalleryScreen(
                  add: "Add",
                ));
          },
          title: "Gallery"),
      body: SingleChildScrollView(
        physics: BouncingScrollPhysics(),
        child: Padding(
          padding: EdgeInsets.symmetric(horizontal: 12),
          child: Column(
            children: [
              SizedBox(height: Get.height * 0.02),
              GetBuilder<GalleyViewController>(builder: (context) {
                return galleyViewController.isLoading
                    ? ListView.builder(
                        itemCount: galleyViewController
                            .galleryinfo?.gallerydata.length,
                        shrinkWrap: true,
                        physics: NeverScrollableScrollPhysics(),
                        itemBuilder: (context, index) {
                          return InkWell(
                            onTap: () {},
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
                                                "${AppUrl.imageurl}${galleyViewController.galleryinfo?.gallerydata[index].img ?? ""}",
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
                                          mainAxisAlignment:
                                              MainAxisAlignment.center,
                                          children: [
                                            SizedBox(
                                                height: Get.height * 0.015),
                                            Row(
                                              children: [
                                                galleyViewController
                                                            .galleryinfo
                                                            ?.gallerydata[index]
                                                            .status ==
                                                        "0"
                                                    ? Text(
                                                        "UnPublish"
                                                            .toUpperCase(),
                                                        style: TextStyle(
                                                            color: BlackColor,
                                                            fontFamily:
                                                                FontFamily
                                                                    .gilroyBold,
                                                            fontSize: 16),
                                                      )
                                                    : Text(
                                                        "Publish".toUpperCase(),
                                                        style: TextStyle(
                                                            color: BlackColor,
                                                            fontFamily:
                                                                FontFamily
                                                                    .gilroyBold,
                                                            fontSize: 16),
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
                                    border:
                                        Border.all(color: Colors.grey.shade200),
                                    color: WhiteColor,
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                ),
                                Positioned(
                                  top: 0,
                                  right: 0,
                                  child: InkWell(
                                      onTap: () {
                                        Get.to(() => AddgalleryScreen(
                                              add: "edit",
                                            ));
                                        addGalleryimageController.getIdAndName(
                                            mid1: galleyViewController
                                                .galleryinfo
                                                ?.gallerydata[index]
                                                .img,
                                            recId: galleyViewController
                                                .galleryinfo
                                                ?.gallerydata[index]
                                                .id);
                                      },
                                      child: Container(
                                        height: 35,
                                        width: 35,
                                        padding: EdgeInsets.all(9),
                                        alignment: Alignment.center,
                                        child: Image.asset("assets/Edit.png"),
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
