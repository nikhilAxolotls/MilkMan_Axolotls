// ignore_for_file: prefer_const_constructors

import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:get_storage/get_storage.dart';
import 'package:storeappnew/intro_Screen/addintro_screen.dart';
import 'firebase_options.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp(options: DefaultFirebaseOptions.currentPlatform);
  await GetStorage.init();
  runApp(
    BoardingScreen(),
  );
}

// ignore: use_key_in_widget_constructors
class BoardingScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      theme: ThemeData(
        primaryColor: Colors.blue,
        hintColor: Colors.orange,
        useMaterial3: false,
      ),
      debugShowCheckedModeBanner: false,
      home: onbording(),
    );
  }
}
