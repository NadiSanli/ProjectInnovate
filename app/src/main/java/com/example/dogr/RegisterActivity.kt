package com.example.dogr

import android.content.Intent
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.util.Patterns
import android.view.View
import com.google.firebase.auth.FirebaseAuth
import kotlinx.android.synthetic.main.activity_register.*
import net.simplifiedcoding.firebaseauthtutorial.utils.login
import net.simplifiedcoding.firebaseauthtutorial.utils.toast

class RegisterActivity : AppCompatActivity() {

    private lateinit var mAuth : FirebaseAuth

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_register)

        mAuth = FirebaseAuth.getInstance()

        /*When the register button is pressed*/
        button_register.setOnClickListener{
            val email = text_email.text.toString().trim()
            val password = edit_text_password.text.toString().trim()

            /*Checks if the email field is empty*/
            if(email.isEmpty())
            {
                text_email.error = "Email Required"
                text_email.requestFocus()
                return@setOnClickListener
            }

            /*Checks if the password field is empty*/
            if(password.isEmpty() || password.length < 6)
            {
                edit_text_password.error = "6 Char password required"
                edit_text_password.requestFocus()
                return@setOnClickListener
            }

            /*Uses the registerUser method with the parameters and registers the user*/
            registerUser(email,password)
        }


        /*Redirects to login page*/
        text_view_login.setOnClickListener()
        {
            startActivity(Intent(this@RegisterActivity, LoginActivity::class.java))
        }
    }

    /*Method for registration */
    private fun registerUser(email: String, password: String) {

        progressbar.visibility = View.VISIBLE

        mAuth.createUserWithEmailAndPassword(email, password)
                .addOnCompleteListener(this)
                {task ->
                    progressbar.visibility = View.GONE
                    if(task.isSuccessful)
                    {
                        login()
                    }
                    else
                    {
                        task.exception?.message?.let {
                            toast(it)
                        }

                    }

                    }
                }

    /*If the register is succesful*/
    override fun onStart() {
        super.onStart()

        mAuth.currentUser?.let{
            login()
        }
    }


    }

