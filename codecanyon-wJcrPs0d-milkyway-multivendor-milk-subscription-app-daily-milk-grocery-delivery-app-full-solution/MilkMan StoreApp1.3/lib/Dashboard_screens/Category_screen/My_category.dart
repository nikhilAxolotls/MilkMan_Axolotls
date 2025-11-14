// ignore_for_file: sort_child_properties_last, prefer_const_constructors, file_names

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Add_category_controller.dart';
import 'package:storeappnew/Controller_class/Category_Controller.dart';
import 'package:storeappnew/Dashboard_screens/Category_screen/Add_category.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class MyCategory extends StatefulWidget {
  const MyCategory({super.key});

  @override
  State<MyCategory> createState() => _MyCategoryState();
}

class _MyCategoryState extends State<MyCategory> {
  CategoryController categoryController = Get.put(CategoryController());
  AddcategoryController addcategoryController =
      Get.put(AddcategoryController());
  @override
  void initState() {
    super.initState();
    categoryController.categorylist();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: CustomAppbar(
        title: "My Category",
        onTap: () {
          Get.to(() => Addcategory(
                edit: "Add",
              ));
        },
      ),
      backgroundColor: WhiteColor,
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 12),
          child: Column(
            children: [
              SizedBox(height: Get.height * 0.02),
              GetBuilder<CategoryController>(builder: (context) {
                return categoryController.isLoading
                    ? ListView.builder(
                        shrinkWrap: true,
                        itemCount: categoryController
                            .categoryinfo?.categorydata.length,
                        padding: EdgeInsets.zero,
                        physics: NeverScrollableScrollPhysics(),
                        itemBuilder: (context, index) {
                          return Stack(
                            children: [
                              Container(
                                height: 70,
                                width: Get.size.width,
                                margin: EdgeInsets.all(10),
                                child: Row(
                                  children: [
                                    SizedBox(
                                      width: 10,
                                    ),
                                    Container(
                                      height: 50,
                                      width: 50,
                                      padding: EdgeInsets.all(13),
                                      alignment: Alignment.center,
                                      child: Image.asset(
                                          "assets/documentlist.png"),
                                      decoration: BoxDecoration(
                                          gradient: gradient.btnGradient,
                                          borderRadius:
                                              BorderRadius.circular(10)),
                                    ),
                                    SizedBox(
                                      width: 10,
                                    ),
                                    Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      mainAxisAlignment:
                                          MainAxisAlignment.center,
                                      children: [
                                        Text(
                                          categoryController.categoryinfo
                                                  ?.categorydata[index].title ??
                                              "",
                                          style: TextStyle(
                                            color: BlackColor,
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 16,
                                          ),
                                        ),
                                        categoryController
                                                    .categoryinfo
                                                    ?.categorydata[index]
                                                    .status ==
                                                "0"
                                            ? Text(
                                                "UnPublish",
                                                style: TextStyle(
                                                  color: greycolor,
                                                  fontFamily:
                                                      FontFamily.gilroyMedium,
                                                ),
                                              )
                                            : Text(
                                                "Publish",
                                                style: TextStyle(
                                                  color: greyColor,
                                                  fontFamily:
                                                      FontFamily.gilroyMedium,
                                                ),
                                              ),
                                      ],
                                    )
                                  ],
                                ),
                                decoration: BoxDecoration(
                                  border:
                                      Border.all(color: Colors.grey.shade200),
                                  borderRadius: BorderRadius.circular(15),
                                ),
                              ),
                              Positioned(
                                top: 0,
                                right: 0,
                                child: InkWell(
                                  onTap: () {
                                    addcategoryController.getIdAndName(
                                        recId: categoryController.categoryinfo
                                                ?.categorydata[index].id ??
                                            "",
                                        categoryName: categoryController
                                                .categoryinfo
                                                ?.categorydata[index]
                                                .title ??
                                            "",
                                        mid1: categoryController.categoryinfo
                                                ?.categorydata[index].img ??
                                            "");
                                    Get.to(() => Addcategory(
                                          edit: "edit",
                                        ));
                                  },
                                  child: Container(
                                    height: 35,
                                    width: 35,
                                    padding: EdgeInsets.all(9),
                                    alignment: Alignment.center,
                                    child: Image.asset("assets/Edit.png"),
                                    decoration: BoxDecoration(
                                      shape: BoxShape.circle,
                                      gradient: gradient.btnGradient,
                                    ),
                                  ),
                                ),
                              )
                            ],
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
