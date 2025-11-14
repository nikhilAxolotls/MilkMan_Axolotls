// ignore_for_file: prefer_const_constructors, sort_child_properties_last, prefer_const_literals_to_create_immutables, non_constant_identifier_names, unused_element, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, avoid_print, deprecated_member_use, unused_field, must_be_immutable, file_names

import 'dart:convert';
import 'dart:io';

import 'package:dotted_border/dotted_border.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:storeappnew/Controller_class/Add_gallery_image_controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AddgalleryScreen extends StatefulWidget {
  String? add;

  AddgalleryScreen({this.add, super.key});

  @override
  State<AddgalleryScreen> createState() => _AddgalleryScreenState();
}

List<String> propartyStatus = ["Publish", "UnPublish"];

class _AddgalleryScreenState extends State<AddgalleryScreen> {
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  AddGalleryimageController addGalleryimageController =
      Get.put(AddGalleryimageController());

  String? selectProperty;

  String slectStatus = propartyStatus.first;

  bool carCheck = false;
  bool sportCheck = false;
  bool laundaryCheck = false;

  @override
  void initState() {
    super.initState();
    if (widget.add == "edit") {
      setState(() {
        addGalleryimageController.medicineImage = "";
        addGalleryimageController.medicineImage = addGalleryimageController.mid;
      });
    } else if (widget.add == "Add") {
      setState(() {
        addGalleryimageController.mid = "";
        addGalleryimageController.medicineImage = "";
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    // notifire = Provider.of<ColorNotifire>(context, listen: true);
    return Scaffold(
      appBar: appbar(title: "Gallery Images"),
      backgroundColor: WhiteColor,
      bottomNavigationBar: Padding(
        padding: EdgeInsets.symmetric(horizontal: 12, vertical: 12),
        child: GestButton(
            Width: Get.size.width,
            height: 55,
            buttoncolor: greenColor,
            buttontext: "Update".tr,
            style: TextStyle(
              fontFamily: FontFamily.gilroyBold,
              color: WhiteColor,
              fontSize: 16,
              fontWeight: FontWeight.bold,
            ),
            onclick: () {
              print(">>>>>>>>>>>>>selectProperty<<<<<<<<<<<<<<$selectProperty");

              if (addGalleryimageController.path != null ||
                  addGalleryimageController.medicineImage != "") {
                if (widget.add == "Add") {
                  addGalleryimageController.addgallery();
                }
                if (widget.add == "edit") {
                  addGalleryimageController.updategallery();
                }
              } else {
                ApiWrapper.showToastMessage("Please Upload Image");
              }
            }),
      ),
      body: Form(
        key: _formKey,
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Expanded(
              child: SingleChildScrollView(
                physics: BouncingScrollPhysics(),
                child: Container(
                  child: Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 14),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        SizedBox(height: Get.height * 0.02),
                        Text(
                          "Product Gallery Image".tr,
                          style: TextStyle(
                            fontFamily: FontFamily.gilroyBold,
                            fontSize: 16,
                            color: BlackColor,
                          ),
                        ),
                        SizedBox(height: Get.height * 0.015),
                        DottedBorder(
                          borderType: BorderType.RRect,
                          color: greenColor,
                          radius: Radius.circular(15),
                          // borderPadding: EdgeInsets.symmetric(horizontal: 20),
                          child: InkWell(
                            onTap: _openGallery,
                            child: ClipRRect(
                              borderRadius: BorderRadius.circular(15),
                              child: widget.add == "Add"
                                  ? Container(
                                      height: 80,
                                      margin:
                                          EdgeInsets.symmetric(horizontal: 20),
                                      width: Get.size.width,
                                      alignment: Alignment.center,
                                      child: addGalleryimageController.path ==
                                              null
                                          ? Image.asset(
                                              "assets/uplodeimage.png",
                                              height: 40,
                                              width: 42,
                                            )
                                          : Image.file(
                                              File(
                                                addGalleryimageController.path
                                                    .toString(),
                                              ),
                                              height: 50,
                                              width: 50,
                                              fit: BoxFit.cover,
                                            ),
                                      decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(15),
                                      ),
                                    )
                                  : Container(
                                      height: 80,
                                      margin:
                                          EdgeInsets.symmetric(horizontal: 20),
                                      width: Get.size.width,
                                      alignment: Alignment.center,
                                      child: addGalleryimageController
                                                  .medicineImage ==
                                              ""
                                          ? Image.asset(
                                              "assets/uplodeimage.png",
                                              height: 40,
                                              width: 42,
                                            )
                                          : addGalleryimageController.path ==
                                                  null
                                              ? Image.network(
                                                  "${AppUrl.imageurl}${addGalleryimageController.medicineImage}",
                                                  height: 50,
                                                  width: 50,
                                                  fit: BoxFit.cover,
                                                )
                                              : Image.file(
                                                  File(
                                                    addGalleryimageController
                                                        .path
                                                        .toString(),
                                                  ),
                                                  height: 50,
                                                  width: 50,
                                                  fit: BoxFit.cover,
                                                ),
                                      decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(15),
                                      ),
                                    ),
                            ),
                          ),
                        ),
                        SizedBox(height: Get.height * 0.02),
                        Text(
                          "Product Image Status".tr,
                          style: TextStyle(
                            fontFamily: FontFamily.gilroyBold,
                            fontSize: 16,
                            color: BlackColor,
                          ),
                        ),
                        SizedBox(height: Get.height * 0.012),
                        Container(
                          height: 60,
                          width: Get.size.width,
                          alignment: Alignment.center,
                          padding: EdgeInsets.only(left: 15, right: 15),
                          child: DropdownButton(
                            value: slectStatus,
                            icon: Image.asset(
                              'assets/Arrowdown.png',
                              height: 20,
                              width: 20,
                            ),
                            isExpanded: true,
                            underline: SizedBox.shrink(),
                            items: propartyStatus
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
                              if (value == "Publish") {
                                addGalleryimageController.status = "1";
                              } else if (value == "UnPublish") {
                                addGalleryimageController.status = "0";
                              }
                              setState(() {
                                slectStatus = value ?? "";

                                // listOfUser.add(selectValue);
                              });
                            },
                          ),
                          decoration: BoxDecoration(
                            color: WhiteColor,
                            borderRadius: BorderRadius.circular(15),
                            border: Border.all(color: Colors.grey.shade200),
                          ),
                        ),
                        SizedBox(height: 25),
                      ],
                    ),
                  ),
                  decoration: BoxDecoration(
                    color: WhiteColor,
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  void _openGallery() async {
    final pickedFile =
        await ImagePicker().getImage(source: ImageSource.gallery);
    if (pickedFile != null) {
      addGalleryimageController.path = pickedFile.path;
      setState(() {});
      File imageFile = File(addGalleryimageController.path.toString());
      List<int> imageBytes = imageFile.readAsBytesSync();
      addGalleryimageController.base64Image = base64Encode(imageBytes);
      print("!!!!!!!!!++++++++++++${addGalleryimageController.base64Image}");
      setState(() {});
    }
  }
}
