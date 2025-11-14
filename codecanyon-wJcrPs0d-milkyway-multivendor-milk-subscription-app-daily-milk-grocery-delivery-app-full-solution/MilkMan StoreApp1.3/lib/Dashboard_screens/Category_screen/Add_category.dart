// ignore_for_file: prefer_const_constructors, sort_child_properties_last, must_be_immutable, file_names, deprecated_member_use, avoid_print

import 'dart:convert';
import 'dart:io';

import 'package:dotted_border/dotted_border.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:storeappnew/Controller_class/Add_category_controller.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class Addcategory extends StatefulWidget {
  String? edit;
  Addcategory({this.edit, super.key});

  @override
  State<Addcategory> createState() => _AddcategoryState();
}

List<String> propartyStatus = ["Publish", "UnPublish"];

class _AddcategoryState extends State<Addcategory> {
  AddcategoryController addcategoryController =
      Get.put(AddcategoryController());
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  @override
  void initState() {
    super.initState();
    if (widget.edit == "edit") {
      setState(() {
        addcategoryController.categoryname.text = "";
        addcategoryController.productImage = "";
        addcategoryController.productImage = addcategoryController.mid;
        addcategoryController.categoryname.text = addcategoryController.catName;
      });
    } else {
      setState(() {
        addcategoryController.mid = "";
        addcategoryController.categoryname.text = "";
      });
    }
  }

  String slectStatus = propartyStatus.first;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: appbar(title: "Add Category"),
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
              if (_formKey.currentState?.validate() ?? false) {
                if (widget.edit == "Add") {
                  addcategoryController.addcategory();
                } else {
                  addcategoryController.updatecategory();
                }
              }
            }),
      ),
      body: Form(
        key: _formKey,
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 12),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                "Category Image".tr,
                style: TextStyle(
                  fontFamily: FontFamily.gilroyBold,
                  fontSize: 16,
                  color: BlackColor,
                ),
              ),
              SizedBox(height: Get.height * 0.012),
              DottedBorder(
                borderType: BorderType.RRect,
                color: greenColor,
                radius: Radius.circular(15),
                // borderPadding: EdgeInsets.symmetric(horizontal: 20),
                child: InkWell(
                  onTap: _openGallery,
                  child: ClipRRect(
                    borderRadius: BorderRadius.circular(15),
                    child: widget.edit == "Add"
                        ? Container(
                            height: 80,
                            margin: EdgeInsets.symmetric(horizontal: 20),
                            width: Get.size.width,
                            alignment: Alignment.center,
                            child: addcategoryController.path == null
                                ? Image.asset(
                                    "assets/uplodeimage.png",
                                    height: 40,
                                    width: 42,
                                  )
                                : Image.file(
                                    File(
                                      addcategoryController.path.toString(),
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
                            margin: EdgeInsets.symmetric(horizontal: 20),
                            width: Get.size.width,
                            alignment: Alignment.center,
                            child: addcategoryController.productImage == ""
                                ? Image.asset(
                                    "assets/uplodeimage.png",
                                    height: 40,
                                    width: 42,
                                  )
                                : addcategoryController.path == null
                                    ? Image.network(
                                        "${AppUrl.imageurl}${addcategoryController.productImage}",
                                        height: 50,
                                        width: 50,
                                        fit: BoxFit.cover,
                                      )
                                    : Image.file(
                                        File(
                                          addcategoryController.path.toString(),
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
              textfield(
                type: "My Category Name",
                controller: addcategoryController.categoryname,
                labelText: "Enter Category Name",
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please Enter Medicine Title';
                  }
                  return null;
                },
              ),
              SizedBox(height: Get.height * 0.02),
              Text(
                "Product Status".tr,
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
                // margin: EdgeInsets.symmetric(horizontal: 10),
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
                      addcategoryController.status = "1";
                    } else if (value == "UnPublish") {
                      addcategoryController.status = "0";
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
            ],
          ),
        ),
      ),
    );
  }

  void _openGallery() async {
    final pickedFile =
        await ImagePicker().getImage(source: ImageSource.gallery);
    if (pickedFile != null) {
      addcategoryController.path = pickedFile.path;
      setState(() {});
      File imageFile = File(addcategoryController.path.toString());
      List<int> imageBytes = imageFile.readAsBytesSync();
      addcategoryController.base64Image = base64Encode(imageBytes);
      print("!!!!!!!!!++++++++++++${addcategoryController.base64Image}");
      setState(() {});
    }
  }
}
