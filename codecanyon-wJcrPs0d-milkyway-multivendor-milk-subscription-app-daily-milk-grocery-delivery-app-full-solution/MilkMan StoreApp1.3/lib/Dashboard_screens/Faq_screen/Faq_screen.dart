// ignore_for_file: sort_child_properties_last, prefer_const_constructors, file_names, prefer_const_literals_to_create_immutables

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Add_Faq_controller.dart';
import 'package:storeappnew/Controller_class/Faq_controller.dart';
import 'package:storeappnew/Dashboard_screens/Faq_screen/Add_faq_screen.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class FaqScreen extends StatefulWidget {
  const FaqScreen({super.key});

  @override
  State<FaqScreen> createState() => _FaqScreenState();
}

class _FaqScreenState extends State<FaqScreen> {
  FaqsController faqsController = Get.put(FaqsController());
  AddFaqsController addFaqsController = Get.put(AddFaqsController());
  @override
  void initState() {
    super.initState();
    faqsController.faqlist();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: CustomAppbar(
        title: "Faq's",
        onTap: () {
          Get.to(() => AddFaqs(
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
              GetBuilder<FaqsController>(builder: (context) {
                return faqsController.isLoading
                    ? ListView.builder(
                        shrinkWrap: true,
                        itemCount: faqsController.faqinfo?.faQdata.length,
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
                                    Expanded(
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        mainAxisAlignment:
                                            MainAxisAlignment.center,
                                        children: [
                                          Text(
                                            faqsController.faqinfo
                                                    ?.faQdata[index].question ??
                                                "",
                                            maxLines: 1,
                                            style: TextStyle(
                                              color: BlackColor,
                                              fontFamily: FontFamily.gilroyBold,
                                              overflow: TextOverflow.ellipsis,
                                              fontSize: 18,
                                            ),
                                          ),
                                          Text(
                                            faqsController.faqinfo
                                                    ?.faQdata[index].answer ??
                                                "",
                                            maxLines: 1,
                                            style: TextStyle(
                                                color:
                                                    greyColor.withOpacity(0.5),
                                                fontFamily:
                                                    FontFamily.gilroyBold,
                                                overflow: TextOverflow.ellipsis,
                                                fontSize: 15),
                                          ),
                                        ],
                                      ),
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
                                    addFaqsController.getIdAndName(
                                        recId: faqsController
                                                .faqinfo?.faQdata[index].id ??
                                            "",
                                        qurstionid: faqsController.faqinfo
                                                ?.faQdata[index].question ??
                                            "",
                                        answerid: faqsController
                                            .faqinfo?.faQdata[index].answer);
                                    Get.to(() => AddFaqs(
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
